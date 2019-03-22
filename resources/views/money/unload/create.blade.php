@extends('layouts.app')
@section('page-title')
    create
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'unload.store','class' => 'form-horizontal', 'files' => true]) }}
                <div class="card-box">
                    <h3 class="card-title">{{ __('unload.create') }}</h3>
                    <div class="row">
                        <div class="col-xs-12">
                            @if($errors->has('justify'))
                                <span class="text-danger">{{ $errors->first('justify') }}</span>
                            @endif
                        </div>

                        <div class="col-md-12">
                            <div class="profile-img-wrap">
                                <img class="inline-block"
                                     src="{{ asset('img/placeholder.jpg') }}" title="justification"
                                     alt="user">
                                <div class="fileupload btn btn-default">
                                    <span class="btn-text">{{ __('validation.attributes.edit') }}</span>
                                    <input class="upload input-file" name="justify"  type="file">
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-md-6">
                                            @include('form.number',[
                                            'title'     => __('validation.attributes.price'),
                                            'name'      => 'prince',
                                            'value'     => null,
                                            'attributes' => ['required','step' => '0.01']
                                            ])
                                        </div>
                                        <div class="col-md-6">
                                            @include('form.date',[
                                            'title'     => __('validation.attributes.date'),
                                            'name'      => 'date',
                                            'value'     => (old('date')) ? old('date') : \Carbon\Carbon::now(),
                                            'attributes' => ['required']
                                            ])
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <div class="form-focus">
                                                    <select name="on" title="on"
                                                            id="on"
                                                            class="form-control"
                                                            required>
                                                        <option disabled selected value>{{ __('validation.attributes.onUnload') }}</option>
                                                        <option value="tva" {{ (old('on') === 'tva') ? 'selected' : '' }}>TVA</option>
                                                        <option value="is" {{ (old('on') === 'is') ? 'selected' : '' }}>IS</option>
                                                    </select>
                                                </div>
                                                @if($errors->has('on'))
                                                    <span class="text-danger">{{ $errors->first('on') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="form-focus">
                                        {{ Form::label('description', ucfirst(__('validation.attributes.description')), ['class' => 'control-label']) }}
                                        {{ Form::textarea('description', null, ['class' => 'form-control form-floating','style' => "min-height: 100px"]) }}
                                    </div>
                                    @if($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-b-30 m-t-30">
                        <div class="text-right m-t-20">
                            <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-edit"></i> {{ __('unload.create') }}</button>
                        </div>
                    </div>
                </div>


                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop