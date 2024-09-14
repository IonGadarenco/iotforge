@extends('layouts.admin')
@section('content')

    <div class="content">
        <div class="col-md-12">
            <div id="one-inbox-side-nav" class="d-none d-md-block push">
                <form action="{{ route('admin.translate.search') }}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="block block-rounded">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Filter</h3>
                            <div class="block-options">
                                <button type="submit" class="btn btn-sm btn-alt-primary" data-bs-toggle="modal"
                                    data-bs-target="#one-inbox-new-message">
                                    <i class="fa fa-binoculars me-1 opacity-50"></i> Search
                                </button>
                            </div>
                        </div>
                        <div class="block-content row">
                            <div class="col-md-2" style="margin-bottom: 20px;">
                                <label for="value_search">{{ __('string.name') }}:</label>
                                <input type="text" class="form-control" value="{{ Request::input('value_search') }}"
                                    name="value_search">
                            </div>

                            <div class="col-md-2">
                                <label for="groups_search">GROUPS:</label>
                                <select class="form-control selectpicker" data-live-search="true" name="groups_search"
                                    id="groups_search">
                                    <option value="">{{ __('string.all') }}</option>

                                    @foreach ($groups as $group)
                                        <option @if (Request::input('groups_search') == $group->group) selected @endif
                                            value="{{ $group->group }}">{{ $group->group }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        {{ trans('link.to_constants') }}
                    </h3>
                    <div class="block-options">
                        <a type="submit" class="btn btn-sm btn-alt-primary" href="{{ route('admin.translate.create') }}">
                            <i class="fa fa-plus me-1 opacity-50"></i> {{ __('string.add') }}
                        </a>
                    </div>
                </div>
                <div class="block-content">
                    <div style="text-align: center">
                        {{ $languages->appends($data)->links() }}
                    </div>
                    @if (isset($languages))
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped no-margin ">
                                <tbody>
                                    <tr>
                                        <th>KEY</th>
                                        <th>EN</th>
                                        <th>RO</th>
                                        <th>RU</th>
                                        <th style="text-align: center;">{{ __('string.actions') }}</th>
                                    </tr>
                                    @foreach ($languages as $language)
                                        <tr>
                                            <td class="d-none d-md-table-cell fs-sm">
                                                {{ $language->group ?? '' }}.{{ $language->key ?? '' }}</td>
                                            <td class="fs-sm">{{ $language->text['en'] }}</td>
                                            <td class="d-none d-sm-table-cell fs-sm">{{ $language->text['ro'] }}</td>
                                            <td class="d-none d-sm-table-cell fs-sm">{{ $language->text['ru'] }}</td>

                                            <td class="text-center fs-sm" style="min-width: 100px;">
                                                <a class="btn btn-sm btn-alt-secondary"
                                                    href="{{ route('admin.translate.edit', ['id' => $language->id]) }}"
                                                    data-bs-toggle="tooltip" title="{{ __('string.edit') }}">
                                                    <i class="fa fa-fw fa-pencil-alt"></i> <span
                                                        class="text-primary"></span>
                                                </a>
                                                <a class="btn btn-sm btn-alt-secondary"
                                                    href="{{ route('admin.translate.delete', ['id' => $language->id]) }}"
                                                    data-bs-toggle="tooltip" title="{{ __('string.delete') }}">
                                                    <i class="fa fa-fw fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div style="text-align: center">
                        {{ $languages->appends($data)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
