@if(isset($deal))
    {{ Form::model($deal,['method' => 'PUT', 'url' => route('deal.update',compact('deal'))]) }}
@else
    {{ Form::open(['method' => 'POST', 'url' => route('deal.store')]) }}
@endif

<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-6">
            @include('form.text',[
           'title'     => __('validation.attributes.name'),
           'name'      => 'name',
           'value'     => (isset($deal->infoBox)) ? $deal->infoBox->name : null,
           'attributes' => ['required']
           ])
        </div>
        <div class="col-xs-6">
            @include('form.email',[
           'title'     => __('validation.attributes.email'),
           'name'      => 'email',
           'value'     => (isset($deal->infoBox->emails[0])) ? $deal->infoBox->emails[0]->email : null,
           'attributes' => ['required']
           ])
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-6">
            @include('form.text',[
           'title'     => __('validation.attributes.phone'),
           'name'      => 'tel',
           'value'     => (isset($deal->infoBox->tels[0])) ? $deal->infoBox->tels[0]->tel : null,
           'attributes' => ['required']
           ])
        </div>
        <div class="col-xs-6">
            @include('form.text',[
           'title'     => __('validation.attributes.speaker'),
           'name'      => 'speaker',
           'value'     => (isset($deal->infoBox->speaker)) ? $deal->infoBox->speaker : null,
           'attributes' => ['required']
           ])
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-6">
            @include('form.text',[
           'title'     => __('validation.attributes.fax'),
           'name'      => 'fax',
           'value'     => (isset($deal->infoBox->fax)) ? $deal->infoBox->fax : null,
           'attributes' => ['required']
           ])
        </div>
        <div class="col-xs-6">
            @include('form.text',[
           'title'     => __('validation.attributes.address'),
           'name'      => 'address',
           'value'     => (isset($deal->infoBox->address)) ? $deal->infoBox->address : null,
           'attributes' => ['required']
           ])
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-4">
            @include('form.number',[
           'title'     => __('validation.attributes.build'),
           'name'      => 'build',
           'value'     => (isset($deal->infoBox->build)) ? $deal->infoBox->build : null,
           'attributes' => ['required']
           ])
        </div>
        <div class="col-xs-4">
            @include('form.number',[
           'title'     => __('validation.attributes.floor'),
           'name'      => 'floor',
           'value'     => (isset($deal->infoBox->floor)) ? $deal->infoBox->floor : null,
           'attributes' => []
           ])
        </div>
        <div class="col-xs-4">
            @include('form.number',[
           'title'     => __('validation.attributes.apt_nbr'),
           'name'      => 'apt_nbr',
           'value'     => (isset($deal->infoBox->floor)) ? $deal->infoBox->floor : null,
           'attributes' => []
           ])
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-6">
            @include('form.text',[
           'title'     => __('validation.attributes.zip'),
           'name'      => 'zip',
           'value'     => (isset($deal->infoBox->zip)) ? $deal->infoBox->zip : null,
           'attributes' => []
           ])
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="form-focus">
                    {{ Form::label('city_id',__('validation.attributes.city'),['class' => 'control-label']) }}
                    <select name="city" id="city" title="city" class="form-control form-floating">
                        @if(!old('city'))
                            <option disabled selected value></option>
                        @endif
                        @foreach(\App\City::all() as $city)
                            <option value="{{ $city->id }}" {{ (isset($deal->infoBox->city_id) && ($deal->infoBox->city_id === $city->id)) ? 'selected' :  (old('city_id') == $city->id) ? 'selected' : '' }}>{{ $city->city }}</option>
                        @endforeach
                    </select>
                </div>
                @if($errors->has('city'))
                    <span class="text-danger">
                                {{ $errors->first('city') }}
                            </span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-12">
            @include('form.text',[
           'title'     => __('validation.attributes.ice'),
           'name'      => 'ice',
           'value'     => (isset($deal->infoBox->ice)) ? $deal->infoBox->ice : null,
           'attributes' => []
           ])
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="col-xs-12">
            <div class="form-group">
                <div class="form-focus">
                    {{ Form::label('description',ucfirst(__('validation.attributes.description')),['class' => 'control-label']) }}
                    {{ Form::textarea('description',null,['class' => 'form-control form-floating','value' => (isset($deal->description)) ? $deal->description : '', 'placeholder' => ucfirst(__('validation.attributes.description'))]) }}
                </div>
                @if ($errors->has('description'))
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="m-t-20 text-right">
    <button class="btn btn-primary">
        <i class="{{ $fa }}"></i> {{ $submit }}
    </button>
</div>


{{ Form::close() }}