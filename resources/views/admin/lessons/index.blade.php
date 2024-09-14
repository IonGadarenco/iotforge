@extends("layouts.admin")
@section("content")
    <div class="content content-full">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lista Cursuri</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                        data-bs-target="#addConsultation">
                        <i class="fa fa-plus me-1 opacity-50"></i> Adaugă Curs
                    </button>
                    @include("admin.lessons.create")
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
                                            <th>Nume</th>
                                            <th>Link</th>
                                            <th>Trainer</th>
                                            <th style="text-align: center">Active</th>
                                            <th style="text-align: center">Acțiuni</th>
                                        </tr>
                                    </thead>
                                    @foreach ($lessons as $lesson)
                                        <tbody class="admin-body">
                                            <tr>
                                                <td>{{ $lesson->name }}</td>
                                                <td>{{ $lesson->link }}</td>
                                                <td>{{ $lesson->trainer }}</td>

                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                            name="active" @if ($lesson->active) checked @endif
                                                            onchange="$.ajax({ url: '{{ route("admin.lessons.changeStatus", $lesson->id) }}' });">
                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <a href="{{ route("admin.lessons.edit", $lesson->id) }}"><i
                                                            class="far fa-edit text-info"></i></a>
                                                    <a href="#"
                                                        onclick="DeleteConfirm('{{ route("admin.lessons.destroy", $lesson->id) }}');"
                                                        data-target="#deleteContact_{{ $lesson->id }}"> <i
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
