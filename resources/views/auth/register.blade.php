@extends('layouts.guest')

@section('title_page')
    {{ strtoupper(__('auth/register.register')) }}
@stop
@section('content')
    <div class="container">
        <h3 class="account-title">{{ strtoupper(__("auth/register.register")) }}</h3>

        <div class="row">
            <div class="col-md-12">
                {{ Form::open(['route' => 'register','class' => 'form-horizontal', 'files' => true]) }}
                <div class="card-box">
                    <h3 class="card-title">{{ __('auth/register.account') }}</h3>
                    <div class="row">
                        <div class="col-md-12">

                            @include('form.img',['name' => 'face'])

                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-md-6">
                                            @include('form.text',[
                                            'title'     => __('validation.attributes.username'),
                                            'name'      => 'name',
                                            'value'     => null,
                                            'attributes' => ['required']
                                            ])
                                        </div>
                                        <div class="col-md-6">
                                            @include('form.text',[
                                             'title'     => __('validation.attributes.token'),
                                             'name'      => 'token',
                                             'value'     => null,
                                             'attributes' => ['required']
                                             ])
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-md-6">
                                            @include('form.text',[
                                             'title'     => __('validation.attributes.email'),
                                             'name'      => 'email',
                                             'value'     => null,
                                             'attributes' => ['required']
                                             ])
                                        </div>
                                        <div class="col-md-6">
                                            @include('form.text',[
                                             'title'     => __('validation.attributes.mobile'),
                                             'name'      => 'tel',
                                             'value'     => null,
                                             'attributes' => ['required']
                                             ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-6">
                                @include('form.password',[
                                 'title'     => __('validation.attributes.password'),
                                 'name'      => 'password',
                                 'attributes' => ['required']
                                 ])
                            </div>
                            <div class="col-md-6">
                                @include('form.password',[
                                 'title'     => __('validation.attributes.password_confirmation'),
                                 'name'      => 'password_confirmation',
                                 'attributes' => ['required']
                                 ])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-box">
                    <h3 class="card-title">{{ __('auth/register.personnel') }}</h3>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="col-md-6">
                                @include('form.text',[
                                 'title'     => __('validation.attributes.last_name'),
                                 'name'      => 'last_name',
                                 'value'     => null,
                                 'attributes' => ['required']
                                 ])
                            </div>
                            <div class="col-md-6">
                                @include('form.text',[
                                 'title'     => __('validation.attributes.first_name'),
                                 'name'      => 'first_name',
                                 'value'     => null,
                                 'attributes' => ['required']
                                 ])
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label for="sex"
                                           class="control-label">{{ ucfirst(__('validation.attributes.sex')) }}</label>
                                    <select id="sex" title="{{__('validation.attributes.sex')}}" name="sex"
                                            class=" form-control floating" required>
                                        <option disabled value
                                                selected>{{ ucfirst(__('validation.attributes.sex')) }}</option>
                                        <option value="homme">{{ __('validation.attributes.homme') }}</option>
                                        <option value="femme">{{ __('validation.attributes.femme') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('form.date',[
                                 'title'     => __('validation.attributes.birth'),
                                 'name'      => 'birth',
                                 'value'     => null,
                                 'attributes' => ['required']
                                 ])
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-md-6">
                                @include('form.text',[
                                 'title'     => __('validation.attributes.address'),
                                 'name'      => 'address',
                                 'value'     => null,
                                 'attributes' => ['required']
                                 ])
                            </div>
                            <div class="col-md-6">
                                @include('form.select',[
                                'title'     => __('validation.attributes.city'),
                                'name'      => 'city',
                                'values'     => \App\City::all(),
                                'attributes' => ['required']
                                ])
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                @include('form.text',[
                                'title'     => __('validation.attributes.cin'),
                                'name'      => 'cin',
                                'value'     => null,
                                'attributes' => []
                                ])
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row m-b-30">
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-user-plus"></i> {{ __('auth/register.register') }}</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
