<div class="col-xs-6">
    @if(!$buy->formed)
        {{ Form::open(['url' => route('trade.form.store',compact('buy')),'files' => true]) }}
    @else
        {{ Form::open(['method' => 'DELETE','url' => route('trade.form.destroy',compact('buy'))]) }}
    @endif
    <div class="profile-img-wrap">
        <img class="inline-block"
             src="{{ ($buy->form) ? asset('storage/' . $buy->form) : asset('img/placeholder.jpg') }}"
             title="formed"
             alt="formed">
        <div class="fileupload btn btn-default">
            <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
            <input class="upload input-file" name="formed" type="file">
        </div>
    </div>
    <div class="profile-basic">
        <div class="col-xs-12 text-left">
            @if($buy->form)
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> {{ __('validation.attributes.delete') }}
                </button>
            @else
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> {{ __('validation.attributes.edit') }}
                </button>
            @endif
        </div>
    </div>
    {{ Form::close() }}
</div>
<div class="col-xs-6">
    <div class="card-box">
        <div class="row">
            <div class="col-xs-12">
                @if($buy->invoice)
                    {{ Form::open(['method' => 'DELETE','url' => route('trade.invoice.destroy',compact('buy')),'files' => true]) }}

                @else
                    {{ Form::open(['url' => route('trade.invoice.store',compact('buy')),'files' => true]) }}
                @endif
                <div class="profile-img-wrap">
                    <img class="inline-block"
                         src="{{ ($buy->invoice) ? asset('storage/' . $buy->invoice) : asset('img/placeholder.jpg') }}"
                         title="formed"
                         alt="formed">
                    <div class="fileupload btn btn-default">
                        <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
                        <input class="upload input-file" name="{{ 'invoice' }}" type="file">
                    </div>
                </div>
                <div class="profile-basic">
                    <div class="col-xs-12 text-left">
                        @if($buy->invoice)
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> {{ __('validation.attributes.delete') }}
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> {{ __('validation.attributes.edit') }}
                            </button>
                        @endif
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

