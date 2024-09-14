@extends("layouts.admin")

@section("content")
    <div class="content content-full">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lista pagini</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal" data-bs-target="#addPages">
                        <i class="fa fa-plus me-1 opacity-50"></i> Adaugă pagină
                    </button>
                    @include("admin.pages.create")
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-8">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-vcenter mb-0">
                                        <thead>
                                            <tr>

                                                <th>{{__('string.name_pages')}}</th>

                                                <th class="text-end col-3" >{{__('string.actions')}}</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body mb-3">

                            <div class="dd" id="nestable">
                                <ol class="dd-list">
                                    @foreach ($pages as $page)
                                        @include("admin.pages.pages_list", ["page" => $page])
                                    @endforeach
                                </ol>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@section("scripts")
    <!--Nestable-->
    <link rel="stylesheet" href="{{ asset("admin_assets/css/nestable.css") }}">
    <script src="{{ asset("admin_assets/js/jquery.nestable.js") }}"></script>

    <script>
        function SavePagesOrder(JSON) {
            $.ajax({
                url: "{{ route("admin.pages.orderPages") }}",
                type: "POST",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'JSON': JSON,
                },
                success: function(response) {
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                },
            });
        }

        $(document).ready(function() {
            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    SavePagesOrder(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            // activate Nestable for list 1
            $('#nestable').nestable({
                    group: 1
                })
                .on('change', updateOutput);

            $('#nestable-menu').on('click', function(e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
        });
    </script>
@endsection
@endsection
