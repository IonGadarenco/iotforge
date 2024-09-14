@extends("layouts.admin")
@section("content")
    <div class="content">
        <div class="hero-static align-items-center">
            <div class="content">
                <div class="row justify-content-center push">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <!-- Sign In Block -->
                        <div class="block block-rounded mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Editare utilizator</h3>
                            </div>
                            <div class="block-content">
                                <div class="p-sm-3 px-lg-6 px-xxl-5 py-lg-5">
                                    <form class="js-validation-signin"
                                        action="{{ route("admin.config.admins.updateOrCreate", [$admin->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method("PUT")
                                        <div class="py-3">
                                            <div class="mb-4">
                                                <label class="form-label" for="name">Nume/Prenume</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old("name") ?? $admin->name }}">
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="{{ old("email") ?? $admin->email }}">
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="roles">{{ __("string.roles") }}</label>
                                                <select class="js-select2 form-select" id="roles" name="roles[]"
                                                    style="width: 100%;" data-placeholder="{{ __("string.roles") }}.."
                                                    multiple>
                                                    @foreach ($roles as $role)
                                                        <option @if ($admin->id && $admin->hasRole($role->id)) selected @endif
                                                            value="{{ $role->id }}">{{ $role->name ?? "" }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="password">Parola</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                            </div>

                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-6 col-xl-5">
                                                <button type="submit" class="btn w-100 btn-alt-primary" value="1"
                                                    name="authorize">
                                                    <i class="fa fa-fw fa-save me-1 opacity-50"></i> {{ __("string.save") }}
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
