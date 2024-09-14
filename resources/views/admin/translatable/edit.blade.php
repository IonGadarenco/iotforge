@extends("layouts.admin")
@section("content")
    <div class="content">
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{ __("string.edit") }}: </h3>
                </div>
                <div class="block-content">
                    <div class="block block-rounded overflow-hidden">
                        <div class="block-content tab-content overflow-hidden">
                            <div class="tab-pane fade fade-up active show" id="secundar" role="tabpanel"
                                aria-labelledby="general-tab">
                                <form action="{{ route("admin.translate.update", ["id" => $edit->id]) }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf

                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label class="form-label">Group</label>
                                                <input type="text" class="form-control" id="group" name="group"
                                                    value="{{ $edit->group }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 ">
                                            <div class="mb-4">
                                                <label class="form-label">Key</label>
                                                <input type="text" class="form-control" id="key" name="key"
                                                    value="{{ $edit->key }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">

                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label class="form-label">English</label>
                                                <input type="text" class="form-control" id="en" name="en"
                                                    value="{{ $edit->text["en"] }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-4 ">
                                            <div class="mb-4">
                                                <label class="form-label">Română</label>
                                                <input type="text" class="form-control" id="ro" name="ro"
                                                    value="{{ $edit->text["ro"] }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <div class="mb-4">
                                                <label class="form-label">Русский</label>
                                                <input type="text" class="form-control" id="ro" name="ru"
                                                    value="{{ $edit->text["ru"] }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right" style="margin-top: 15px; float: right">
                                        <a href="{{ route("admin.translate") }}" class="btn btn-sm btn-danger">
                                            Cancel
                                        </a>
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            Save <i class="fa fa-save"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
