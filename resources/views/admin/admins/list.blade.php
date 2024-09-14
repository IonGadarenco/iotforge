@extends("layouts.admin")
@section("content")
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __("string.filter") }}</h3>

            </div>
            <div class="block-content">
                <form action="{{ route("admin.config.admins") }}" method="GET" enctype="multipart/form-data"
                    style="margin-bottom: 15px">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <span>Admin name</span>
                                <input type="text" class="form-control" value="{{ Request::input("name") }}"
                                    name="name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <span>Admin email</span>
                                <input type="text" class="form-control" value="{{ Request::input("email") }}"
                                    name="email">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <span>Status</span>
                                <select class="form-control selectpicker" data-live-search="true" name="status"
                                    id="status">
                                    <option value="3" @if (!Request::input("status") || Request::input("status") == 3) selected @endif>Toate</option>
                                    <option value="1" @if (Request::input("status") == 1) selected @endif>Activi
                                    <option value="2" @if (Request::input("status") == 2) selected @endif>Inactivi
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1" style="align-self: end">
                            <span></span>
                            <button type="submit" class="btn btn-primary">{{ __("string.search") }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __("string.admins") }}</h3>
                <div class="block-options">
                    <a href=" {{ route("admin.config.admins.create") }}"
                        class="btn btn-sm ink-reaction btn-raised btn-primary align-right">
                        <i class="fa fa-plus"></i> {{ __("string.add") }}
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>

                                <th>Admin name</th>
                                <th>{{ __("string.roles") }}</th>
                                <th>Admin email</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 100px;">{{ __("string.actions") }}</th>
                            </tr>
                        </thead>
                        @foreach ($admins as $admin)
                            <tbody>
                                <tr>
                                    <td class="fw-semibold fs-sm">
                                        {{ $admin->name ?? "" }}
                                    </td>
                                    <td class="fs-sm">
                                        @foreach ($admin->roles as $role)
                                            {{ $role->name ?? "" }} @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="fs-sm">{{ $admin->email ?? "" }}</td>
                                    <td>
                                        @if ($admin->active == 1)
                                            <a href="{{ route("admin.config.admins.status", [0, $admin->id]) }}"><span
                                                    class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Activ</span></a>
                                        @else
                                            <a href="{{ route("admin.config.admins.status", [1, $admin->id]) }}"><span
                                                    class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">Inactiv</span></a>
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <a href="{{ route("admin.config.admins.edit", [$admin->id]) }}"><i
                                                        class="fa fa-fw fa-pencil-alt"></i></a>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-alt-danger"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <a href="javascript:void(0)"><i class="fa fa-fw fa-times"
                                                        onclick="DeleteConfirm('{{ route("admin.config.admins.delete", $admin->id) }}')"></i></a>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
