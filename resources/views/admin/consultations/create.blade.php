<div class="modal" id="addConsultation" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Adăugare Consultatie</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form class="row gutters" method="post" enctype="multipart/form-data" action="{{route('admin.consultations.store')}}" id="add_form">
                        @csrf
                        <div class="col-12  mb-4">
                            <div class="form-group">
                                <label for="name_new">Nume:</label>
                                <input type="text" class="form-control" name="name"  value="">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Renunță</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="$('#add_form').submit();">Salvează</button>
                </div>
            </div>
        </div>
    </div>
</div>
