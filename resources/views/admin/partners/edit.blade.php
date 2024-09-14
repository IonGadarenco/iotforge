@extends("layouts.admin")
@section("content")
    <form class="row" method="post" enctype="multipart/form-data"
        action="{{ route("admin.partners.update", $partner->id) }}" id="add_form">
        @csrf
        <div class="content content-full">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Editare partener</h3>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route("admin.partners") }}" class="btn btn-outline-secondary me-1">Renunță</a>
                        <button type="submit" class="btn btn-primary">
                            Salvează
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="border border-info ">
                                        <div class="alert alert-info d-flex justify-content-between align-items-center"
                                            role="alert">
                                            <div>
                                                <i class="icon-info1"></i>
                                                Click pe imagine pentru a modifica
                                            </div>
                                            <a href="#"
                                                onclick="DeleteConfirm('{{ route("admin.partners.delete_image_general", $partner->id) }}');"
                                                data-target="#deleteContact_{{ $partner->id }}">
                                                <i class="far fa-image"></i>&nbsp;→&nbsp;
                                                <i class="far fa-trash-alt text-danger"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <img class="img-fluid m-1" id="general_image" src="{{ $partner->pictureUrl }}"
                                                alt="{{ $partner->name }}" onclick="$('#uploadPhoto').click();" />
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
                                <div class="col-lg-7">
                                    <div class="row ">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="link"><i class="fas fa-globe"></i> Link:</label>
                                                <input type="text" class="form-control" name="link" id="link"
                                                    placeholder="link.com" value="{{ $partner->link }}">
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
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="ro_name">Nume(RO):
                                                            </label>
                                                            <input type="text" class="form-control" name="ro_name"
                                                                id="ro_name"
                                                                value="{{ $partner->translate("ro")->name ?? "" }}">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="block-content tab-pane" id="english" role="tabpanel"
                                                aria-labelledby="english-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="en_name">Nume(EN):</label>
                                                            <input type="text" class="form-control" name="en_name"
                                                                id="en_name"
                                                                value="{{ $partner->translate("en")->name ?? "" }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="block-content tab-pane" id="russian" role="tabpanel"
                                                aria-labelledby="russian-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="ru_name">Nume(RU):</label>
                                                            <input type="text" class="form-control" name="ru_name"
                                                                id="ru_name"
                                                                value="{{ $partner->translate("ru")->name ?? "" }}">
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
                url: "{{ route("admin.partners.storeImageGeneral", $partner->id) }}",
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
