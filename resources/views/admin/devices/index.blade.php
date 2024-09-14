@extends("layouts.admin")
@section("content")
    <div class="content content-full">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lista Dispozitivelor</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                        data-bs-target="#addDeevice">
                        <i class="fa fa-plus me-1 opacity-50"></i> Adaugă Dispozitiv
                    </button>
                    @include("admin.devices.create")
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <div style="text-align: center">
                                {{ $devices->appends($data)->links() }}
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="admin-head">
                                        <tr>
                                            <th>Nume</th>
                                            <th>Tip</th>
                                            <th>Identificatorul</th>
                                            <th>User id</th>
                                            <th style="text-align: center;">Active</th>
                                            <th style="text-align: right">Acțiuni</th>
                                        </tr>
                                    </thead>
                                    @foreach ($devices as $device)
                                        <tbody class="admin-body">
                                            <tr>
                                                <td>{{ $device->name }}</td>
                                                <td>{{ $device->device_type }}</td>
                                                <td>{{ $device->device_identifier }}</td>
                                                <td>{{ $device->user->name }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                               name="active"
                                                               @if ($device->active) checked @endif
                                                               onchange="$.ajax({ url: '{{ route('admin.devices.changeStatus', $device->id) }}' });">
                                                    </div>
                                                </td>
                                                <td align="right">
                                                    <a href="{{ route("admin.devices.edit", $device->id) }}"><i
                                                            class="far fa-edit text-info"></i></a>
                                                    <a href="#"
                                                        onclick="DeleteConfirm('{{ route("admin.devices.destroy", $device->id) }}');"
                                                        data-target="#deleteContact_{{ $device->id }}"> <i
                                                            class="far fa-trash-alt text-danger"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <div style="text-align: center">
                                {{ $devices->appends($data)->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
