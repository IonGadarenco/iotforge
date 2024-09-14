<div class="modal" id="DeleteModal" tabindex="-1" aria-labelledby="modal-block-normal" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">{{trans('string.delete')}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <p>{{trans('string.confirm_delete')}}</p>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">{{trans('string.cancel')}}</button>
                    <a id="delete_url"><button type="button" class="btn btn-sm btn-primary" data-bs-dismiss="modal">{{trans('string.delete')}}</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
