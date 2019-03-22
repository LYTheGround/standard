<div id="delete_position{{ $position->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">{{ $position->info->last_name . ' ' . $position->info->first_name }}</h4>
            </div>
            <div class="modal-body card-box">
                <p>{{ __('diver.sur') }}</p>
                {!! __('rh/position.modal_delete') !!}
                <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">{{ __('diver.close') }}</a>
                    <span onclick="event.preventDefault();document.getElementById('{{ 'delete-position-' . $position->id }}').submit()" class="btn btn-danger">{{ __('rh/position.delete') }}</span>
                    <form action="{{route('position.destroy',compact('position'))}}" method="POST" id="{{ 'delete-position-' . $position->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
