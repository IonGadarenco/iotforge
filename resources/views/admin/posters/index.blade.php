@extends("layouts.admin")
@section("content")
    <div class="content content-full">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lista bannere</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                        data-bs-target="#addPosters">
                        <i class="fa fa-plus me-1 opacity-50"></i> Adaugă banner
                    </button>
                    @include("admin.posters.create")
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="admin-head">
                                        <tr>
                                            <th>Nr.</th>
                                            <th>Nume</th>
                                            <th>Link</th>
                                            <th style="text-align: center">Active</th>
                                            <th style="text-align: center">Acțiuni</th>
                                        </tr>
                                    </thead>
                                    @foreach ($posters as $poster)
                                        <tbody class="admin-body">
                                            <tr>
                                                <td>{{ $loop->iteration }}. <img src="{{ $poster->pictureUrl }}" alt="Poster Image"
                                                    class="img-fluid" style="max-width: 150px; height: auto;"></td>
                                                <td>{{ $poster->name }}</td>

                                                <td>{{ $poster->link }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active" @if ($poster->active) checked @endif
                                                            onchange="$.ajax({ url: '{{ route("admin.posters.changeStatus", $poster->id) }}' });">
                                                    </div>
                                                </td>
                                                <td  style="text-align: center; vertical-align: middle;">
                                                    <a href="{{ route("admin.posters.edit", $poster->id) }}"><i
                                                            class="far fa-edit text-info"></i></a>
                                                    <a href="#"
                                                        onclick="DeleteConfirm('{{ route("admin.posters.destroy", $poster->id) }}');"
                                                        data-target="#deleteContact_{{ $poster->id }}"> <i
                                                            class="far fa-trash-alt text-danger"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
