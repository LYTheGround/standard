@if(isset($product))
    {{ Form::model($product,['method' => 'PUT', 'url' => route('product.update',compact('product')), 'files'=> true]) }}
@else
    {{ Form::open(['method' => 'POST', 'url' => route('product.store'), 'files'=> true]) }}
@endif

<div class="row">
    <div class="col-xs-6">
        @include('form.text',[
            'title'     => __('validation.attributes.name'),
            'name'      => 'name',
            'value'     => null,
            'attributes' => ['required']
            ])
    </div>
    <div class="col-md-6">
        @include('form.text',[
            'title'     => __('validation.attributes.size'),
            'name'      => 'size',
            'value'     => null,
            'attributes' => []
            ])
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <div class="form-focus">
                {{ Form::label('tva', ucfirst(__('validation.attributes.tva')),['class' => 'control-label']) }}
                <select name="tva" id="tva" title="tva" class="form-control form-floating" required>
                    <option disabled selected value>{{ ucfirst(__('validation.attributes.tva')) }}</option>
                    <option value="0" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '0')) ? 'selected' : '' : (old('tva') == '0') ? 'selected' : '' }}>
                        0%
                    </option>
                    <option value="7" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '7')) ? 'selected' : '' : (old('tva') == '7') ? 'selected' : '' }}>
                        7%
                    </option>
                    <option value="10" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '10')) ? 'selected' : '' : (old('tva') == '10') ? 'selected' : '' }}>
                        10%
                    </option>
                    <option value="14" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '14')) ? 'selected' : '' : (old('tva') == '14') ? 'selected' : '' }}>
                        14%
                    </option>
                    <option value="20" {{ (!old('tva')) ? (isset($product->tva) && ($product->tva == '20')) ? 'selected' : '' : (old('tva') == '20') ? 'selected' : '' }}>
                        20%
                    </option>
                </select>
            </div>
            @if ($errors->has('tva'))
                <div class="text-danger">{{ $errors->first('tva') }}</div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        @include('form.number',[
            'title'     => __('validation.attributes.min_qt'),
            'name'      => 'min_qt',
            'value'     => null,
            'attributes' => ['required','min' => 1]
            ])
    </div>
</div>

<div class="row m-t-30">
    <div class="col-xs-12">
        <div class="form-group">
            {{ Form::label('description',ucfirst(__('validation.attributes.description')),['class' => 'control-label']) }}
            {{ Form::textarea('description',null,['class' => 'form-control', 'placeholder' => ucfirst(__('validation.attributes.description'))]) }}
            @if ($errors->has('description'))
                <div class="text-danger">{{ $errors->first('description') }}</div>
            @endif
        </div>
    </div>
</div>


<div class="row" style="min-height: 150px !important;">
    <div class="col-xs-12 text-center">
        <div class="form-group">
            <div class="row">
                <!-- Our File Inputs -->
                <div class="col-sm-3 col-xs-6">
                    <div class="profile-img-wrap">
                        <img class="inline-block"
                             src="{{ (isset($product->imgs[0])) ? asset('storage/' . $product->imgs[0]->img) : asset('img/placeholder.jpg') }}"
                             title="{{ (isset($product) ? $product->name : 'Produit') }}"
                             alt="{{ (isset($product) ? $product->name : 'Produit') }}">
                        <div class="fileupload btn btn-default">
                            @if(isset($product->imgs[0]))
                                <a href="#" class="btn-text"
                                   data-toggle="modal" data-target="#delete_img{{ $product->imgs[0]->id }}">{{ __('validation.attributes.delete') }}</a>
                            @else
                                <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
                                <input class="upload input-file" name="img[0]" type="file">
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="profile-img-wrap">
                        <img class="inline-block"
                             src="{{ (isset($product->imgs[1])) ? asset('storage/' . $product->imgs[1]->img) : asset('img/placeholder.jpg') }}"
                             title="{{ (isset($product) ? $product->name : 'Produit') }}"
                             alt="{{ (isset($product) ? $product->name : 'Produit') }}">
                        <div class="fileupload btn btn-default">
                            @if(isset($product->imgs[1]))
                                <a href="#" class="btn-text"
                                   data-toggle="modal" data-target="#delete_img{{ $product->imgs[1]->id }}">{{ __('validation.attributes.delete') }}</a>
                            @else
                                <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
                                <input class="upload input-file" name="img[1]" type="file">
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="profile-img-wrap">
                        <img class="inline-block"
                             src="{{ (isset($product->imgs[2])) ? asset('storage/' . $product->imgs[2]->img) : asset('img/placeholder.jpg') }}"
                             title="{{ (isset($product) ? $product->name : 'Produit') }}"
                             alt="{{ (isset($product) ? $product->name : 'Produit') }}">
                        <div class="fileupload btn btn-default">
                            @if(isset($product->imgs[2]))
                                <a href="#" class="btn-text"
                                   data-toggle="modal" data-target="#delete_img{{ $product->imgs[2]->id }}">{{ __('validation.attributes.delete') }}</a>
                            @else
                                <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
                                <input class="upload input-file" name="img[2]" type="file">
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="profile-img-wrap">
                        <img class="inline-block"
                             src="{{ (isset($product->imgs[3])) ? asset('storage/' . $product->imgs[3]->img) : asset('img/placeholder.jpg') }}"
                             title="{{ (isset($product) ? $product->name : 'Produit') }}"
                             alt="{{ (isset($product) ? $product->name : 'Produit') }}">
                        <div class="fileupload btn btn-default">
                            @if(isset($product->imgs[3]))
                                <a href="#" class="btn-text"
                                   data-toggle="modal" data-target="#delete_img{{ $product->imgs[3]->id }}">{{ __('validation.attributes.delete') }}</a>
                            @else
                                <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
                                <input class="upload input-file" name="img[3]" type="file">
                            @endif
                        </div>
                    </div>

                </div>
            </div>


            @if ($errors->has('img'))
                <div class="text-danger">{{ $errors->first('img') }}</div>
            @endif
        </div>
    </div>
</div>


<div class="m-t-20 text-right">
    <button class="btn btn-primary">
        <i class="{{ $fa }}"></i> {{ $submit }}
    </button>
</div>

{{ Form::close() }}

@if(isset($product->imgs[0]))
    @foreach($product->imgs as $img)
        @include('storage.product._delete_img',compact('img'))
    @endforeach
@endif