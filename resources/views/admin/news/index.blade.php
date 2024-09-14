@extends('layouts.admin')
@section('content')
    <div class="content content-full">
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Lista noutăți</h3>
                <div class="block-options">
                    <button type="button" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal" data-bs-target="#addNews">
                        <i class="fa fa-plus me-1 opacity-50"></i> Adaugă noutate
                    </button>
                    @include('admin.news.create')
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
                                            <th>Data</th>
                                            <th style="text-align: center;">Active</th>
                                            <th style="text-align: right">Acțiuni</th>
                                        </tr>
                                    </thead>
                                    @foreach ($news as $news_single)
                                        <tbody class="admin-body">
                                            <tr>
                                                <td>{{ $news_single->name }}</td>
                                                <td>{{ $news_single->data }}</td>

                                                <td style="text-align: center; vertical-align: middle;">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" id="active"
                                                               name="active"
                                                               @if ($news_single->active) checked @endif
                                                               onchange="$.ajax({ url: '{{ route('admin.news.change_status', $news_single->id) }}' });">
                                                    </div>
                                                </td>
                                                <td align="right">
                                                    <a href="{{ route('admin.news.edit', $news_single->id) }}"><i
                                                            class="far fa-edit text-info"></i></a>
                                                    <a href="#"
                                                        onclick="DeleteConfirm('{{ route('admin.news.destroy', $news_single->id) }}');"
                                                        data-target="#deleteContact_{{ $news_single->id }}"> <i
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
