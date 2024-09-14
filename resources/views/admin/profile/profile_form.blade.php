@extends("layouts.admin")
@section("content")
    <div class="bg-image" style="background-image: url('assets/media/photos/photo10@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center">
                <div class="my-3">
                    <img class="img-avatar img-avatar-thumb"
                    src="{{ $user->picture ? asset('storage/' . $user->picture) : asset('assets/img/favicon.ico') }}"
                    alt="{{ $user->name }}">
                </div>

                <h1 class="h2 text-white mb-0">{{ $user->name }}</h1>
                <h2 class="h4 fw-normal text-white-75">
                    Edit Account
                </h2>
                <a class="btn btn-alt-secondary" href="{{ route("dashboard") }}">
                    <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
    <div class="content content-boxed">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">User Profile</h3>
            </div>
            <div class="block-content">
                <form action="{{ route("profile.edit") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="row push">
                        <div class="col-2 border-right">
                            <p class="fs-sm text-muted">
                                Informația vitală a contului dvs.
                            </p>
                            @if (session()->has("success"))
                                <div class="alert alert-success">
                                    {{ session("success") }}
                                </div>
                            @endif
                        </div>
                        <div class="col-6 border-right">
                            <div class="mb-4">
                                <label class="form-label" for="one-profile-edit-name">Username</label>
                                <input type="text" class="form-control @error("name") is-invalid @enderror"
                                    id="one-profile-edit-name" name="name" placeholder="Enter your name.."
                                    value="{{ $user->name }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="one-profile-edit-login">Email</label>
                                <input type="text" class="form-control @error("email") is-invalid @enderror"
                                    id="one-profile-edit-login" name="email" placeholder="Enter your email.."
                                    value="{{ $user->email }}" readonly>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label " for="one-profile-edit-password-new">New Password</label>
                                    <input type="password" class="form-control @error("password") is-invalid @enderror"
                                        id="one-profile-edit-password-new" name="password">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label" for="password_confirmation">Confirm New
                                        Password</label>
                                    <input type="password"
                                        class="form-control @error("password_confirmation") is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="col-3 ">
                            <div class="mb-4">
                                <label class="form-label">Avatarul dvs.</label>
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <img class="img-avatar me-3"
                                         src="{{ $user->picture ? asset('storage/' . $user->picture) : asset('assets/img/favicon.ico') }}"
                                         alt="{{ $user->name }}">
                                    <a href="#"
                                    onclick="DeleteConfirm('{{ route('profile.delete_image_general', $user->id) }}');"
                                    data-target="#deleteContact_{{ $user->id }}">
                                     <i class="far fa-image"></i>&nbsp;→&nbsp;
                                     <i class="far fa-trash-alt text-danger"></i>
                                 </a>
                                </div>
                            </div>


                            <div class="mb-4">
                                <label for="one-profile-edit-avatar" class="form-label">Alege o nou poză</label>
                                <input class="form-control" type="file" id="one-profile-edit-avatar" name="picture">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4 text-end">
                        <button type="submit" class="btn btn-alt-primary">
                            Update
                        </button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
