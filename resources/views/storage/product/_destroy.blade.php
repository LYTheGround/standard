<div id="delete_product{{ $product->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">{{ $product->name}}</h4>
            </div>
            <div class="modal-body card-box">
                <p>{{ __('pages.diver.sure') }}</p>
                {!! __('storage/product.modal_delete') !!}
                <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">{{ __('validation.attributes.close') }}</a>
                    <span onclick="event.preventDefault();document.getElementById('{{ 'delete-product-' . $product->id }}').submit()" class="btn btn-danger">{{ __('validation.attributes.delete') }}</span>
                    <form action="{{route('product.destroy',compact('product'))}}" method="POST" id="{{ 'delete-product-' . $product->id }}">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>