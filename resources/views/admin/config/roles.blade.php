@extends("layouts.admin")
@section("content")
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ __("string.roles") }}</h3>
                <div class="block-options">
                    <a href="{{ route("user.config.role_edit") }}" class="btn btn-sm btn-alt-success">
                        {{ __("string.add_role") }} <i class="fa fa-plus me-1 opacity-50"></i>
                    </a>
                </div>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>{{ __("string.role_name") }}</th>
                                <th>{{ __("string.permissions") }}</th>
                                <th class="text-center" style="width: 100px;">{{ __("string.actions") }}</th>
                            </tr>
                        </thead>
                        @foreach ($roles as $role)
                            <tbody>
                                <tr>
                                    <td class="fw-semibold fs-sm">
                                        {{ $role->name ?? "" }}
                                    </td>
                                    <td class="fs-sm">
                                        @foreach ($role->permissions as $permission)
                                            {{ $permission->name ?? "" }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <a href="{{ route("user.config.role_edit", [$role->id]) }}"><i
                                                        class="fa fa-fw fa-pencil-alt"></i></a>
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
