@extends('layouts.admin')
@section('content')
    <div class="content">
    <div class="hero-static align-items-center">
        <div class="content">
            <div class="row justify-content-center push">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <!-- Sign In Block -->
                    <div class="block block-rounded mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Editare Rol</h3>
                        </div>
                        <div class="block-content">
                            <div class="p-sm-3 px-lg-6 px-xxl-5 py-lg-5">
                                <form class="js-validation-signin" action="{{ route('user.config.role_update', [$role->id])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="py-3">
                                        <div class="mb-4">
                                            <label class="form-label" for="name">{{__('string.role_name')}}</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{old('name') ?? $role->name}}">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="roles">{{__('string.permissions')}}</label>
                                            <select class="js-select2 form-select" id="permissions" name="permissions[]" style="width: 100%;" data-placeholder="{{__('string.permissions')}}.." multiple>
                                                @foreach($permissions as $permission)
                                                    <option @if($role->id && $role->hasPermission($permission->id)) selected @endif value="{{$permission->id}}">{{$permission->name ?? ''}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6 col-xl-5">
                                            <button type="submit" class="btn w-100 btn-alt-primary" value="1"  name="authorize">
                                                <i class="fa fa-fw fa-save me-1 opacity-50"></i> {{__('string.save')}}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- END Sign In Form -->
                            </div>
                        </div>
                    </div>
                    <!-- END Sign In Block -->
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

