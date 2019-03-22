<div id="edit_position{{ $position->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('rh/position.edit') }}</h4>
            </div>
            <div class="modal-body">
                <div class="m-b-30">
                    @include('position._form',['submit' => __('rh/position.edit'),'info' => $position->info, 'fa' => 'fa-edit'])
                </div>
            </div>
        </div>
    </div>
</div>
