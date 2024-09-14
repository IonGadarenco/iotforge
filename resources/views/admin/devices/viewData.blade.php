<div class="modal" id="seeData_{{$device->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-block-normal" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Dispozitivul - {{$device->name}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">

                    <div class="col-12 mb-4">
                        <div class="form-group">
                            <label for="data">Date citite:</label>
                            <textarea class="form-control" name="data" id="data" rows="6"></textarea>
                        </div>
                    </div>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Renunță</button>
                </div>
            </div>
        </div>
    </div>
</div>
