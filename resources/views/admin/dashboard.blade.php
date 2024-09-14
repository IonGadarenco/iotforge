@extends("layouts.admin")
@section("content")
    <div class="bg-image overflow-hidden"
        style="background-image: url('{{ asset("admin_assets/media/admin_dashboard.jpg") }}');">
        <div class="bg-primary-dark-op">
            <div class="content content-full">
                <div
                    class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-start">
                    <div class="flex-grow-1">
                        <h1 class="fw-semibold text-white mb-0">Dashboard</h1>
                        <h2 class="h4 fw-normal text-white-75 mb-0">Welcome Administrator</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="content" >
        <div class="row">
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ __("string.statistic_1") }}</div>
                        <div class="fs-2 fw-normal text-dark">{{ $totalAccessCount ?? 0 }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ __("string.statistic_2") }}</div>
                        <div class="fs-2 fw-normal text-dark">{{ $completedOrdersCount ?? 0 }}</div>
                    </div>
                </a>
            </div>

            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ __("string.statistic_3") }}</div>
                        <div class="fs-2 fw-normal text-dark">{{ $productsCount ?? 0 }}</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 col-lg-6 col-xl-3">
                <a class="block block-rounded block-link-pop border-start border-primary border-4"
                    href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-sm fw-semibold text-uppercase text-muted">{{ __("string.statistic_4") }}</div>
                        <div class="fs-2 fw-normal text-dark">{{ $categoriesCount ?? 0 }}</div>
                    </div>
                </a>
            </div>

        </div>

    </div>
@endsection
@push("scripts")
    <script src="{{ asset("/admin_assets/js/plugins/chart.js/chart.umd.js") }}"></script>
    <script src="{{ asset("/admin_assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js") }}"></script>
    <script src="{{ asset("/admin_assets/js/plugins/select2/js/select2.full.min.js") }}"></script>
    <script src="{{ asset("/admin_assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js") }}"></script>
    <script src="{{ asset("/admin_assets/js/pages/be_pages_dashboard_v1.min.js") }}"></script>
    <script>
        One.helpersOnLoad(['jq-datepicker', 'jq-select2', 'jq-rangeslider']);
    </script>
@endpush
