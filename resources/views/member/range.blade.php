@extends('layouts.app')
@section('page-title')
    {{ __('rh/member.range_title') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <h1>{{ __('rh/member.range_title') }}</h1>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6">
                <div class="dash-widget dash-widget5">
                    <span class="dash-widget-icon @if($member->company->premium->sold > 10) bg-success @elseif ($member->company->premium->sold > 5) bg-warning @else bg-danger @endif">
                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    </span>
                    <div class="dash-widget-info m-b-10">
                        <span>{{ __('token.company_sold') }} : </span>
                        <h2>{{ $member->company->premium->sold . ' ' . __('validation.attributes.days') }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="dash-widget dash-widget5">
                    <span class="dash-widget-icon bg-info">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </span>
                    <div class="dash-widget-info m-b-10">
                        <span>{{ __('validation.attributes.limit_days_account',['value' => \App\Premium::diffDaysLimit($member->premium->limit)]) }}</span>
                        <h2>{{ __('validation.attributes.sold') }}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                {{ Form::open(['method' => 'PUT', 'url' => route('member.range.update',compact('member')),'class' => 'form-horizontal']) }}
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-12 m-b-30">
                            <label for="range" class="control-label">{{ __('validation.attributes.range') }} :</label>
                            <input type="number" name="range" value="{{ old('range') ?: '1' }}" id="range" class="form-control" placeholder="{{ __('pages.rh.user.range.range') }}"
                                   min="1" max="{{ $member->company->premium->sold }}" required>
                        </div>
                        @if($errors->has('range'))
                            <span class="error-box text-danger">{{ $errors->first('range') }}</span>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus"></i> {{ __('rh/member.add_range') }}
                        </button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
