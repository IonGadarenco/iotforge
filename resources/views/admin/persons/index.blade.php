@extends("layouts.admin")
@section("content")
    <div class="content content-full">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lista persoanelor</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                        data-bs-target="#addPerson">
                        <i class="fa fa-plus me-1 opacity-50"></i> Adaugă persoană
                    </button>
                    @include("admin.persons.create")
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
                                            <th>Nume/Prenume</th>
                                            <th>Poziția</th>
                                            <th style="text-align: center">Activ</th>
                                            <th style="text-align: center">Acțiuni</th>
                                        </tr>
                                    </thead>
                                    @foreach ($persons as $person)
                                        <tbody class="admin-body">
                                            <tr>
                                                <td>{{ $person->name }}</td>
                                                <td>{{ $person->position }}</td>

                                            <td style="text-align: center; vertical-align: middle;">
                                                <div class="form-check form-switch d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" id="active"
                                                           name="active"
                                                           @if ($person->active) checked @endif
                                                           onchange="$.ajax({ url: '{{ route('admin.persons.changeStatus', $person->id) }}' });">
                                                </div>
                                            </td>
                                                <td align="center">
                                                    <a href="{{ route("admin.persons.edit", $person->id) }}"><i
                                                            class="far fa-edit text-info"></i></a>
                                                    <a href="#"
                                                        onclick="DeleteConfirm('{{ route("admin.persons.destroy", $person->id) }}');"
                                                        data-target="#deleteContact_{{ $person->id }}"> <i
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
