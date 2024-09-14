<div class="modal modal-sheet p-4 py-md-5" tabindex="-1" role="dialog" id="{{$id}}">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-5">{{$modalTitle}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0" id="{{$id}}_container_body">
                @isset ($modal_body)
                    {{ $modal_body }}
                @endisset
            </div>
            <div class="modal-footer flex-column align-items-stretch gap-2 pb-3 border-top-0">
                <div class="row">
                    <div class="col text-center">
                        <button type="button" class="btn btn-lg btn-primary" id="{{$id}}_submit">Save</button>
                    </div>
                    <div class="col text-center">
                        <button type="button" class="btn btn-lg btn-secondary" data-bs-dismiss="modal" id="{{$id}}_close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>