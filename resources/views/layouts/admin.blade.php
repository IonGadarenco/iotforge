<!DOCTYPE html>
<html>

    <head>
        @include("admin.components.head")

    </head>

    <body>
        <div id="page-container"
            class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed
             @if (\Illuminate\Support\Facades\Session::exists("dark_theme")) side-trans-enabled page-header-dark dark-mode @endif">

            <nav id="sidebar" aria-label="Main Navigation ">
                <div class="content-header">
                    <a class="fw-semibold text-dual" href="{{ route("dashboard") }}"
                        style="padding-left: 35px !important;">
                        <span class="smini-visible">
                            <i class="fa fa-circle-notch text-primary"></i>
                        </span>
                        <span class="smini-hide fs-5 tracking-wider">{{ __("string.site_name") }}</span>
                    </a>
                </div>

                <div class="js-sidebar-scroll">
                    <!-- Side Navigation -->
                    @if (Auth::guard("web")->check())
                        <div class="content-side">
                            <ul class="nav-main">
                                @include("admin.components.navigation")
                            </ul>
                        </div>
                    @endif
                </div>
            </nav>
            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout"
                            data-action="sidebar_toggle">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>

                        <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-none d-lg-inline-block"
                            data-toggle="layout" data-action="sidebar_mini_toggle">
                            <i class="fa fa-fw fa-ellipsis-v"></i>
                        </button>

                        <!-- END Search Form -->
                    </div>

                    <div class="d-flex align-items-center ms-auto">
                        <div class="text-muted me-2">Mail: <u>{{ Auth::guard("web")->user()->email }}</u></div>
                        <div class="dropdown d-inline-block ms-2">
                            <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                                id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img class="rounded-circle"
                                    src="{{ Auth::guard("web")->user()->picture ? asset("storage/" . Auth::guard("web")->user()->picture) : asset("admin_assets/media/avatars/avatar0.jpg") }}"
                                    alt="User Avatar" style="width: 21px; ">
                                <span
                                    class="d-none d-sm-inline-block ms-2">{{ Auth::guard("web")->user()->name }}</span>
                                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block opacity-50 ms-1 mt-1"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                                aria-labelledby="page-header-user-dropdown">

                                <div class="p-2">
                                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                                        href="{{ route("profile.edit") }}">
                                        <span class="fs-sm fw-medium"> <i class="fa fa-user"></i>
                                            {{ __("link.to_cabinet_personal") }}</span>
                                    </a>
                                </div>

                                <div role="separator" class="dropdown-divider m-0"></div>
                                <div class="p-2">

                                    <a class="dropdown-item d-flex align-items-center justify-content-between"
                                        href="{{ route("logout") }}">
                                        <span class="fs-sm fw-medium"> <i class="fa fa-sign-out-alt"></i> Log
                                            Out</span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Language Selector -->
                        <div class="dropdown d-inline-block ms-2">
                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                {{ strtoupper(app()->getLocale()) }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-xs dropdown-menu-end p-0 border-0 fs-sm"
                                aria-labelledby="page-header-notifications-dropdown">
                                <ul class="nav-items mb-0">
                                    @foreach (\App\Models\Locale::all() as $locale)
                                        <li>
                                            <a class="text-dark d-flex py-2"
                                                href="{{ route("language", ["lang" => $locale->locale]) }}"
                                                @if ($locale->locale == app()->getLocale()) style="background: #4b76d9; color: white !important; font-weight: bold;" @endif>
                                                <div class="flex-shrink-0 me-2 ms-3">
                                                    {{ $locale->language }}
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- END Right Section -->

                <div id="page-header-loader" class="overlay-header bg-body-extra-light">
                    <div class="content-header">
                        <div class="w-100 text-center">
                            <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>

            <main id="main-container" style="background-image: url('{{ asset("admin_assets/images/auth-bg.png") }}');">
                @include("components.alerts")

                @yield("content")
            </main>
            <!-- END Main Container -->

            @include("components.delete_modal")
            <!-- Footer -->
            <footer id="page-footer" class="bg-body-light">
                <div class="content py-3">
                    <div class="row fs-sm">
                        <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                            Developed by <a class="fw-semibold" href="https://www.moldahost.com/"
                                target="_blank">MoldaHost</a>
                        </div>
                        <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                            <a class="fw-semibold" href="#" target="_blank">{{ __("string.site_name") }}</a>
                            &copy; <span data-toggle="year-copy"></span>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        @include("admin.components.scripts")

    </body>

</html>
