@extends('layouts.admin')
@section('content')
    <form class="row" method="post" enctype="multipart/form-data" action="{{ route('admin.devices.update', $device->id) }}"
        id="add_form">
        @csrf
        <div class="content content-full">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Editare Dispozitiv</h3>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.devices') }}" class="btn btn-outline-secondary me-1">Renunță</a>
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
                                    <div class="border border-info ">
                                        <div class="alert alert-info d-flex justify-content-between align-items-center"
                                            role="alert">
                                            <div>
                                                <i class="icon-info1"></i>
                                                Click pe imagine pentru a modifica
                                            </div>
                                            <a href="#"
                                                onclick="DeleteConfirm('{{ route('admin.devices.delete_image_general', $device->id) }}');"
                                                data-target="#deleteContact_{{ $device->id }}">
                                                <i class="far fa-image"></i>&nbsp;→&nbsp;
                                                <i class="far fa-trash-alt text-danger"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <img class="img-fluid m-1" id="general_image" src="{{ $device->pictureUrl }}"
                                                alt="{{ $device->name }}" onclick="$('#uploadPhoto').click();" />
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
                                    <div class="mt-5 mb-2">
                                        @include('admin.components.files.main', [
                                            'parent' => $device,
                                            'type' => 'Device',
                                        ])
                                    </div>
                                    <div class="border border-info mb-3 p-2">
                                        @include('admin.components.gallery.gallery', [
                                            'parent' => $device,
                                            'type' => 'Device',
                                        ])
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="row border border-info py-3 ">

                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="device_identifier"><i
                                                        class="fas fa-laptop-code"></i>
                                                    IMEI</label>
                                                <input type="text" class="form-control" name="device_identifier"
                                                    id="device_identifier" value="{{ $device->device_identifier ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label" for="user_id"><i class="fas fa-users"></i> User</label>
                                                <select class="form-control" name="user_id" id="user_id">
                                                    <option value="">Select a User</option>
                                                    @foreach (App\Models\User::all() as $user)
                                                        <option value="{{ $user->id }}" {{ $device->user_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="mdate"><i class="fas fa-calendar-alt"></i>
                                                    Prima conectare</label>
                                                <input type="date" class="form-control" placeholder="YYYY-MM-DD"
                                                    name="start_date" id="mdate"
                                                    value="{{ $device->start_date ?? date('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="mdate"><i
                                                        class="fas fa-calendar-times"></i>
                                                    Ultima conectare</label>
                                                <input type="date" class="form-control" placeholder="YYYY-MM-DD"
                                                    name="end_date" id="mdate"
                                                    value="{{ $device->end_date ?? date('Y-m-d') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label" for="device_type"><i
                                                        class="fas fa-charging-station"></i>
                                                    Tip</label>
                                                <input type="text" class="form-control" name="device_type"
                                                    id="device_type" value="{{ $device->device_type ?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="block block-rounded row g-0 border border-info">
                                        <ul class="nav nav-tabs nav-tabs-block flex-md-column col-md-2" role="tablist">
                                            <li class="nav-item d-md-flex flex-md-column">
                                                <button type="button" class="nav-link text-md-start active"
                                                    id="romana-tab" data-bs-toggle="tab" data-bs-target="#romana"
                                                    role="tab" aria-controls="romana" aria-selected="true">
                                                    Romana
                                                </button>
                                            </li>
                                            {{-- <li class="nav-item d-md-flex flex-md-column">
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
                                            </li> --}}
                                        </ul>
                                        <div class="tab-content col-md-10">
                                            <div class="block-content tab-pane active" id="romana" role="tabpanel"
                                                aria-labelledby="romana-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="name">Nume(RO): </label>
                                                            <input type="text" class="form-control" name="name"
                                                                id="name" value="{{ $device->name ?? '' }}">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label" for="ro_content">Descriere(RO):</label>
                                                    <textarea id="ro_content" name="ro_content">{{ $device->content ?? '' }}</textarea>
                                                </div>
                                            </div>
                                            {{--
                                            <div class="block-content tab-pane" id="english" role="tabpanel"
                                                aria-labelledby="english-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="en_name">Nume(EN):</label>
                                                            <input type="text" class="form-control" name="en_name"
                                                                id="en_name"
                                                                value="{{ $device->translate("en")->name ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="en_funder">Finantator(EN):
                                                            </label>
                                                            <input type="text" class="form-control" name="en_funder"
                                                                id="en_funder"
                                                                value="{{ $device->translate("en")->funder ?? "" }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label" for="en_content">Scopul
                                                        proiectului(EN):</label>
                                                    <textarea id="en_content" name="en_content">{{ $device->translate("en")->content ?? "" }}</textarea>
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
                                                                value="{{ $device->translate("ru")->name ?? "" }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="mb-4">
                                                            <label class="form-label" for="ru_funder">Finantator(RU):
                                                            </label>
                                                            <input type="text" class="form-control" name="ru_funder"
                                                                id="ru_funder"
                                                                value="{{ $device->translate("ru")->funder ?? "" }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-4">
                                                    <label class="form-label" for="ru_content">Scopul
                                                        proiectului(RU):</label>
                                                    <textarea id="ru_content" name="ru_content">{{ $device->translate("ru")->content ?? "" }}</textarea>
                                                </div>
                                            </div> --}}
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
@push('scripts')
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
                url: "{{ route('admin.devices.storeImageGeneral', $device->id) }}",
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
