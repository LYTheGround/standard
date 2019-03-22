@extends('layouts.app')
@section('page-title')
    {{ __('rh/member.params') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ Form::model($member->info,['route' => 'member.update','class' => 'form-horizontal', 'files' => true]) }}
                <div class="card-box">
                    <h3 class="card-title">{{ __('auth/register.account') }}</h3>
                    <div class="row">
                        <div class="col-md-12">

                            @include('form.img',['name' => 'face', 'img' => $member->info->face])

                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="col-md-6">
                                            @include('form.text',[
                                            'title'     => __('validation.attributes.username'),
                                            'name'      => 'name',
                                            'value'     => $member->name,
                                            'attributes' => ['required']
                                            ])
                                        </div>
                                        <div class="col-md-6">
                                            @include('form.text',[
                                            'title'     => __('validation.attributes.cin'),
                                            'name'      => 'cin',
                                            'value'     => null,
                                            'attributes' => []
                                            ])
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-md-6">
                                            @include('form.text',[
                                             'title'     => __('validation.attributes.email'),
                                             'name'      => 'email',
                                             'value'     => $member->info->emails[0]->email,
                                             'attributes' => ['required']
                                             ])
                                        </div>
                                        <div class="col-md-6">
                                            @include('form.text',[
                                             'title'     => __('validation.attributes.mobile'),
                                             'name'      => 'phone',
                                             'value'     => $member->info->tels[0]->tel,
                                             'attributes' => ['required']
                                             ])
                                        </div>
                                    </div>
                                </div>
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
                                 'value'     => $member->info->last_name,
                                 'attributes' => ['required']
                                 ])
                            </div>
                            <div class="col-md-6">
                                @include('form.text',[
                                 'title'     => __('validation.attributes.first_name'),
                                 'name'      => 'first_name',
                                 'value'     => $member->info->first_name,
                                 'attributes' => ['required']
                                 ])
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-md-6">
                                <div class="form-group form-focus select-focus">
                                    <label for="sex"
                                           class="control-label">{{ ucfirst(__('validation.attributes.sex')) }}</label>
                                    <select id="sex" title="{{__('validation.attributes.sex')}}" name="sex"
                                            class="select form-control floating" required>
                                        <option disabled value
                                                selected>{{ ucfirst(__('validation.attributes.sex')) }}</option>
                                        <option value="homme" {{ ($member->info->sex === 'homme') ? 'selected' : '' }}>{{ __('validation.attributes.homme') }}</option>
                                        <option value="femme" {{ ($member->info->sex === 'femme') ? 'selected' : '' }}>{{ __('validation.attributes.femme') }}</option>
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
                                'val'     => $member->info->city_id,
                                'attributes' => ['required']
                                ])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-b-30">
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-edit"></i> {{ __('rh/member.update') }}</button>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop