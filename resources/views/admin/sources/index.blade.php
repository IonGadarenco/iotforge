@extends("layouts.admin")
@section("content")
    <div class="content content-full">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lista surse</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                        data-bs-target="#addSources">
                        <i class="fa fa-plus me-1 opacity-50"></i> Adaugă sursa
                    </button>
                    @include("admin.sources.create")
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
                                    @foreach ($sources as $source)
                                        <tbody class="admin-body">
                                            <tr>
                                                <td>{{ $loop->iteration }}. <img src="{{ $source->pictureUrl }}" alt="Source Image"
                                                    class="img-fluid" style="max-width: 150px; height: auto;"></td>
                                                <td>{{ $source->name }}</td>

                                                <td>{{ $source->link }}</td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active" @if ($source->active) checked @endif
                                                            onchange="$.ajax({ url: '{{ route("admin.sources.changeStatus", $source->id) }}' });">
                                                    </div>
                                                </td>
                                                <td  style="text-align: center; vertical-align: middle;">
                                                    <a href="{{ route("admin.sources.edit", $source->id) }}"><i
                                                            class="far fa-edit text-info"></i></a>
                                                    <a href="#"
                                                        onclick="DeleteConfirm('{{ route("admin.sources.destroy", $source->id) }}');"
                                                        data-target="#deleteContact_{{ $source->id }}"> <i
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
