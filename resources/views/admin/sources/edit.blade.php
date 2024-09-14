@extends("layouts.admin")
@section("content")
    <form class="row" method="post" enctype="multipart/form-data" action="{{ route("admin.sources.update", $source->id) }}"
        id="add_form">
        @csrf
        @method("PUT")
        <div class="content content-full">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Editare sursa</h3>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route("admin.sources") }}" class="btn btn-outline-secondary me-1">Renunță</a>
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
                                                onclick="DeleteConfirm('{{ route("admin.sources.delete_image_general", $source->id) }}');"
                                                data-target="#deleteContact_{{ $source->id }}">
                                                <i class="far fa-image"></i>&nbsp;→&nbsp;
                                                <i class="far fa-trash-alt text-danger"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <img style="max-width: 500px;" class="click-image m-1" id="general_image"
                                                src="{{ $source->pictureUrl }}" alt="{{ $source->name }}"
                                                onclick="$('#uploadPhoto').click();" />
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
                                </div>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="link"><i class="fas fa-link"></i>&nbsp;Link:</label>
                                                <input type="link" class="form-control" placeholder="link.md"
                                                    name="link" id="link" value="{{ $source->link ?? "" }}">
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
                                                        id="ro_name" value="{{ $source->translate("ro")->name ?? "" }}">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ro_content">description(RO)</label>
                                                    <div class="m-1">
                                                        <textarea id="ro_content" name="ro_content">{{ $source->translate("ro")->content ?? "" }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block-content tab-pane" id="english" role="tabpanel"
                                                aria-labelledby="english-tab">
                                                <div class="mb-4">
                                                    <label class="form-label" for="en_name">Nume(EN):</label>
                                                    <input type="text" class="form-control " name="en_name"
                                                        id="en_name" value="{{ $source->translate("en")->name ?? "" }}">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="en_content">description(EN)</label>
                                                    <div class="m-1">
                                                        <textarea id="en_content" name="en_content">{{ $source->translate("en")->content ?? "" }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="block-content tab-pane" id="russian" role="tabpanel"
                                                aria-labelledby="russian-tab">
                                                <div class="mb-4">
                                                    <label class="form-label" for="ru_name">Nume(RU):</label>
                                                    <input type="text" class="form-control " name="ru_name"
                                                        id="ru_name"
                                                        value="{{ $source->translate("ru")->name ?? "" }}">
                                                </div>
                                                <div class="form-group row">
                                                    <label for="ru_content">description(RU)</label>
                                                    <div class="m-1">
                                                        <textarea id="ru_content" name="ru_content">{{ $source->translate("ru")->content ?? "" }}</textarea>
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
                url: "{{ route("admin.sources.storeImageGeneral", $source->id) }}",
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
