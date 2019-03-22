<div id="delete_img{{ $img->id }}" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">{{ $product->name}}</h4>
            </div>
            <div class="modal-body card-box">
                <p>{{ __('pages.diver.sure') }}</p>
                {!! __('storage/product.modal_delete') !!}
                <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">{{ __('validation.attributes.close') }}</a>
                    <span onclick="event.preventDefault();document.getElementById('delete-img-{{$img->id}}').submit()" class="btn btn-danger">{{ __('validation.attributes.delete') }}</span>
                    {{ Form::open(['method' => 'delete', 'id' => "delete-img-" . $img->id, 'url' => route('product.img.destroy',['product' => $product, 'product_img' => $img])]) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>