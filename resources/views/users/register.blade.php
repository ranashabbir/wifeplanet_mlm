@extends('layouts.index')

@section('title')
    {!! __('Register User') !!}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-post" id="post_card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            {!! __('Register User') !!}
                            <div class="pull-right">
                                {{-- <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ __('usersmanagement.tooltips.back-users') }}">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    {!! __('usersmanagement.buttons.back-to-users') !!}
                                </a> --}}
                            </div>
                        </div>
                    </div>
        
                    <div class="card-body">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <ul>
                                    <li>{!! \Session::get('success') !!}</li>
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(array('route' => 'user.addregisteruser', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}            
                            <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                                {!! Form::label('email', __('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => __('forms.create_user_ph_email'))) !!}
                                        <div class="input-group-append">
                                            <label for="email" class="input-group-text">
                                                <i class="fa fa-fw {{ __('forms.create_user_icon_email') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                {!! Form::label('name', __('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => __('forms.create_user_ph_firstname'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="name">
                                                <i class="fa fa-fw {{ __('forms.create_user_icon_firstname') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group has-feedback row {{ $errors->has('lastname') ? ' has-error ' : '' }}">
                                {!! Form::label('lastname', __('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('lastname', NULL, array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => __('forms.create_user_ph_lastname'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="lastname">
                                                <i class="fa fa-fw {{ __('forms.create_user_icon_lastname') }}" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('lastname'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group has-feedback row {{ $errors->has('phone') ? ' has-error ' : '' }}">
                                {!! Form::label('phone', __('Phone'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        {!! Form::text('phone', NULL, array('id' => 'phone', 'class' => 'form-control', 'placeholder' => __('Phone'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="lastname">
                                                <i class="fa fa-fw fa-phone" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            <div class="form-group has-feedback row {{ $errors->has('country') ? ' has-error ' : '' }}">
                                {!! Form::label('country', __('Country'), array('class' => 'col-md-3 control-label')); !!}
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <select class="form-control" name="country" id="country">
                                            <option value="">{{ __('Country') }}</option>
                                            @if ($countries)
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}" @if ($country->id == old('country'))
                                                        selected
                                                    @endif>{{ $country->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="lastname">
                                                <i class="fa fa-fw fa-globe" aria-hidden="true"></i>
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('country'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('country') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
        
                            {!! Form::button(__('Submit'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts/footer')
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#country').select2();
});
</script>
@endsection
