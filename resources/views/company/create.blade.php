@extends('layouts.admin.admin')
@section('page-title')
    {{ __('company/company.create') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4>{{ __('company/company.create') }}</h4>
            </div>
        </div>
        <div class="card-box">
            {{ Form::open(['method' => 'POST', 'url' => route('company.store'),"files" => true ]) }}
            <div class="row">
                    <div class="form-group">
                        <div class="profile-img-wrap">
                            <img class="inline-block"
                                 src="{{ asset('img/placeholder.jpg') }}" title="user"
                                 alt="user">
                            <div class="fileupload btn btn-default">
                                <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
                                <input class="upload input-file" name="brand_" accept="image/x-png,image/gif,image/jpeg" type="file">
                            </div>
                        </div>
                        @if ($errors->has('brand_'))
                            <div class="help-block">{{ $errors->first('brand_') }}</div>
                        @endif
                    </div>
                <div class="profile-basic">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-focus">
                                    {{ Form::label('name',ucfirst(__("validation.attributes.name")),['class' => 'control-label']) }}
                                    {{ Form::text('name',null,['class' => 'form-control form-floating','required']) }}
                                </div>
                                @if($errors->has('name'))
                                    <span class="text-danger">
                                {{ $errors->first('name') }}
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-focus">
                                    {{ Form::label('email',ucfirst(__("validation.attributes.email")),['class' => 'control-label']) }}
                                    {{ Form::email('email',null,['class' => 'form-control form-floating','required']) }}
                                </div>
                                @if($errors->has('email'))
                                    <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-focus">
                                    {{ Form::label('tel',ucfirst(__("validation.attributes.phone")),['class' => 'control-label']) }}
                                    {{ Form::tel('tel',null,['class'=>'form-control form-floating','required']) }}
                                </div>
                                @if($errors->has('tel'))
                                    <span class="text-danger">
                                {{ $errors->first('tel') }}
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-focus">
                                    {{ Form::label('fax',ucfirst(__("validation.attributes.fax")),['class' => 'control-label']) }}
                                    {{ Form::tel('fax',null,['class'=>'form-control form-floating']) }}
                                </div>
                                @if($errors->has('fax'))
                                    <span class="text-danger">
                                {{ $errors->first('fax') }}
                            </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="form-focus">
                                    {{ Form::label('speaker',ucfirst(__("validation.attributes.speaker")),['class' => 'control-label']) }}
                                    {{ Form::text('speaker',null,['class'=>'form-control form-floating','required']) }}
                                </div>
                                @if($errors->has('speaker'))
                                    <span class="text-danger">
                                {{ $errors->first('speaker') }}
                            </span>
                                @endif
                            </div>
                        </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('licence',ucfirst(__("validation.attributes.licence")),['class' => 'control-label']) }}
                            {{ Form::text('licence',null,['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('licence'))
                            <span class="text-danger">
                                {{ $errors->first('licence') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('turnover',ucfirst(__("validation.attributes.turnover")),['class' => 'control-label']) }}
                            {{ Form::number('turnover',null,['class' => 'form-control form-floating','placeholder'=>'Turnover','required']) }}
                        </div>
                        @if($errors->has('turnover'))
                            <span class="text-danger">
                                {{ $errors->first('turnover') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('taxes',ucfirst(__("validation.attributes.taxes")),['class' => 'control-label']) }}
                            {{ Form::number('taxes',null,['class' => 'form-control form-floating','placeholder'=>'Taxes','required']) }}
                        </div>
                        @if($errors->has('taxes'))
                            <span class="text-danger">
                                {{ $errors->first('taxes') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('ice',ucfirst(__("validation.attributes.ice")),['class' => 'control-label']) }}
                            {{ Form::number('ice',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('ice'))
                            <span class="text-danger">
                                {{ $errors->first('ice') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('address',ucfirst(__("validation.attributes.address")),['class' => 'control-label']) }}
                            {{ Form::text('address',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('address'))
                            <span class="text-danger">
                                {{ $errors->first('address') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('build',ucfirst(__("validation.attributes.build")),['class' => 'control-label']) }}
                            {{ Form::number('build',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('build'))
                            <span class="text-danger">
                                {{ $errors->first('build') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('floor',ucfirst(__('validation.attributes.floor')),['class' => 'control-label']) }}
                            {{ Form::text('floor',null,['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('floor'))
                            <span class="text-danger">
                                {{ $errors->first('floor') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('apt_nbr',ucfirst(__('validation.attributes.apt_nbr')),['class' => 'control-label']) }}
                            {{ Form::number('apt_nbr',null,['class' => 'form-control form-floating']) }}
                        </div>
                        @if($errors->has('apt_nbr'))
                            <span class="text-danger">
                                {{ $errors->first('apt_nbr') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('zip',ucfirst(__("validation.attributes.zip")),['class' => 'control-label']) }}
                            {{ Form::number('zip',null,['class' => 'form-control form-floating','required']) }}
                        </div>
                        @if($errors->has('zip'))
                            <span class="text-danger">
                                {{ $errors->first('zip') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-focus">
                            {{ Form::label('city_id','Ville :',['class' => 'control-label']) }}
                            <select name="city" id="city" title="city" class="form-control form-floating">
                                @if(!old('city'))
                                    <option disabled selected value></option>
                                @endif
                                @foreach(\App\City::all() as $city)
                                    <option value="{{ $city->id }}" {{ (old('city_id') == $city->id) ? 'selected' : '' }}>{{ $city->city }}</option>
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

            <div class="row">
                <div class="col-xs-12 text-right">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> {{ __("company/company.add") }}</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
