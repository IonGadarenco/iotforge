@extends("layouts.admin")

@section("content")
    <form class="row" method="post" enctype="multipart/form-data"
        action="{{ route("admin.news.update", $news_single->id) }}" id="add_form">
        @csrf
        @method("PUT")
        <div class="content content-full">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Editare Noutate</h3>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route("admin.news") }}" class="btn btn-outline-secondary me-1">Renunță</a>
                        <button type="submit" class="btn btn-primary">
                            Salvează
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 d-flex flex-column">
                                    <div class="border border-info">
                                        <div class="alert alert-info d-flex justify-content-between align-items-center "
                                            role="alert">
                                            <div>
                                                <i class="icon-info1"></i>
                                                Click pe imagine pentru a modifica
                                            </div>
                                            <a href="#"
                                                onclick="DeleteConfirm('{{ route("admin.news.delete_image_general", $news_single->id) }}');"
                                                data-target="#deleteContact_{{ $news_single->id }}">
                                                <i class="far fa-image"></i>&nbsp;→&nbsp;
                                                <i class="far fa-trash-alt text-danger"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <img class="img-fluid m-1" id="general_image" src="{{ $news_single->pictureUrl }}"
                                                alt="{{ $news_single->name }}" onclick="$('#uploadPhoto').click();" />
                                        </div>

                                        <div class="form-group m-0" style="display: none">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="picture" class="custom-file-input"
                                                        id="uploadPhoto">
                                                    <label class="custom-file-label" for="uploadPhoto"
                                                        aria-describedby="uploadPhotoAddon"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="  mt-5 mb-2">
                                        @include("admin.components.files.main", [
                                            "parent" => $news_single,
                                            "type" => "News",
                                        ])
                                    </div>
                                    <div class="border border-info mb-3 p-2">
                                        @include("admin.components.gallery.gallery", [
                                            "parent" => $news_single,
                                            "type" => "News",
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mdate">Data</label>
                                                <input type="date" class="form-control" placeholder="YYYY-MM-DD"
                                                    name="data" id="mdate"
                                                    value="{{ $news_single->data ?? date("Y-m-d") }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Părintele</label>
                                                <select class="form-control" name="parent">
                                                    <option value="">Selectează părintele</option>
                                                    @foreach (\App\Models\Page::getParentsForNews() as $page)
                                                        <option value="{{ $page->id }}"
                                                            @if ($news_single->parent == $page->id) selected @endif>
                                                            {{ $page->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Proiectul</label>
                                                <select class="form-control" name="project_id">
                                                    <option value="">Selectează proiectul</option>
                                                    @foreach (\App\Models\Project::getProjectsForNews() as $news)
                                                        <option value="{{ $news_single->id }}"
                                                            @if ($news_single->news == $news_single->id) selected @endif>
                                                            {{ $news_single->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="block block-rounded row g-0 border border-info">
                                        <ul class="nav nav-tabs nav-tabs-block flex-md-column col-md-2" role="tablist">
                                            <li class="nav-item d-md-flex flex-md-column">
                                                <button type="button" class="nav-link text-md-start active" id="romana-tab"
                                                    data-bs-toggle="tab" data-bs-target="#romana" role="tab"
                                                    aria-controls="romana" aria-selected="true">
                                                    Romana
                                                </button>
                                            </li>
                                            <li class="nav-item d-md-flex flex-md-column">
                                                <button type="button" class="nav-link text-md-start" id="english-tab"
                                                    data-bs-toggle="tab" data-bs-target="#english" role="tab"
                                                    aria-controls="btabs-vertical-profile" aria-selected="false">
                                                    English
                                                </button>
                                            </li>
                                            <li class="nav-item d-md-flex flex-md-column">
                                                <button type="button" class="nav-link text-md-start" id="russian-tab"
                                                    data-bs-toggle="tab" data-bs-target="#russian" role="tab"
                                                    aria-controls="btabs-vertical-settings" aria-selected="false">
                                                    Russian
                                                </button>
                                            </li>
                                        </ul>
                                        <div class="tab-content col-md-10">
                                            <div class="block-content tab-pane active" id="romana" role="tabpanel"
                                                aria-labelledby="romana-tab">
                                                <div class="mb-4">
                                                    <label class="form-label" for="ro_name">Nume(RO):</label>
                                                    <input type="text" class="form-control " name="ro_name"
                                                        id="ro_name"
                                                        value="{{ $news_single->translate("ro")->name ?? "" }}">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ro_content">Content(RO)</label>
                                                    <div class="m-1">
                                                        <textarea id="ro_content" name="ro_content">{{ $news_single->translate("ro")->content ?? "" }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block-content tab-pane" id="english" role="tabpanel"
                                                aria-labelledby="english-tab">
                                                <div class="mb-4">
                                                    <label class="form-label" for="en_name">Nume(EN):</label>
                                                    <input type="text" class="form-control " name="en_name"
                                                        id="en_name"
                                                        value="{{ $news_single->translate("en")->name ?? "" }}">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="en_content">Content(EN)</label>
                                                    <div class="m-1">
                                                        <textarea id="en_content" name="en_content">{{ $news_single->translate("en")->content ?? "" }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block-content tab-pane" id="russian" role="tabpanel"
                                                aria-labelledby="russian-tab">
                                                <div class="mb-4">
                                                    <label class="form-label" for="ru_name">Nume(RU):</label>
                                                    <input type="text" class="form-control " name="ru_name"
                                                        id="ru_name"
                                                        value="{{ $news_single->translate("ru")->name ?? "" }}">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ru_content">Content(RU)</label>
                                                    <div class="m-1">
                                                        <textarea id="ru_content" name="ru_content">{{ $news_single->translate("ru")->content ?? "" }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push("scripts")
    <script>
        /**
         * Initiate Ajax request when add image
         */
        $('#uploadPhoto').change(function() {
            store_image_general()
        })

        /**
         * Store image to gallery and update gallery content
         */
        function store_image_general() {
            var fileInput = document.getElementById('uploadPhoto');
            var dataForm = new FormData();
            var file = fileInput.files[0];
            dataForm.append('picture', file);

            $.ajax({
                url: "{{ route("admin.news.store_image_general", $news_single->id) }}",
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: dataForm,
                success: function(response) {
                    console.log(response);
                    $('#general_image').attr('src', response);
                },
                error: function(response) {
                    console.log(response);
                },
                processData: false,
                contentType: false,
            });
        }
    </script>
@endpush
