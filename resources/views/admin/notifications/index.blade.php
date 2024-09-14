@extends("user.index")
@section("content")
    <div class="content">
        <div class="col-md-12">
            <div class="" style="margin-bottom: 15px">

            </div>
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __("string.notifications") }}</h3>
                </div>
                <div class="block-content tab-content">
                    <div class="tab-pane active" role="tabpanel" aria-labelledby="btabs-static-home-tab">
                        <div class="text-center">
                            {{ $notifications->appends($data)->links("pagination::bootstrap-4") }}
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless table-striped table-vcenter">
                                <thead>
                                    <tr>
                                        <th>{{ __("string.created_at") }}</th>
                                        <th>{{ __("string.feedback_message") }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($notifications as $notification)
                                        @if (!$notification->read)
                                            <tr class="text-primary">
                                                <td>{{ \App\Classes\DateFormat::niceDateTime($notification->created_at) }}
                                                </td>
                                                <td>{{ $notification->message }}</td>
                                            </tr>
                                        @else
                                            <tr class="text-success">
                                                <td>{{ \App\Classes\DateFormat::niceDateTime($notification->created_at) }}
                                                </td>
                                                <td>{{ $notification->message }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
