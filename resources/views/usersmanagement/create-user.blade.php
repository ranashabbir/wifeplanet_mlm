@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('template_fastload_css')
@endsection

@section('content')
    <div class="card-header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            {!! trans('usersmanagement.create-new-user') !!}
            <div class="pull-right">
                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ trans('usersmanagement.tooltips.back-users') }}">
                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                    {!! trans('usersmanagement.buttons.back-to-users') !!}
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        {!! Form::open(array('route' => 'users.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}

            {!! csrf_field() !!}

            <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                {!! Form::label('email', trans('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <div class="input-group">
                        {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_email'))) !!}
                        <div class="input-group-append">
                            <label for="email" class="input-group-text">
                                <i class="fa fa-fw {{ trans('forms.create_user_icon_email') }}" aria-hidden="true"></i>
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
                {!! Form::label('name', trans('forms.create_user_label_username'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <div class="input-group">
                        {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_username'))) !!}
                        <div class="input-group-append">
                            <label class="input-group-text" for="name">
                                <i class="fa fa-fw {{ trans('forms.create_user_icon_username') }}" aria-hidden="true"></i>
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

            <div class="form-group has-feedback row {{ $errors->has('first_name') ? ' has-error ' : '' }}">
                {!! Form::label('first_name', trans('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <div class="input-group">
                        {!! Form::text('first_name', NULL, array('id' => 'first_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                        <div class="input-group-append">
                            <label class="input-group-text" for="first_name">
                                <i class="fa fa-fw {{ trans('forms.create_user_icon_firstname') }}" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    @if ($errors->has('first_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('first_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group has-feedback row {{ $errors->has('last_name') ? ' has-error ' : '' }}">
                {!! Form::label('last_name', trans('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <div class="input-group">
                        {!! Form::text('last_name', NULL, array('id' => 'last_name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                        <div class="input-group-append">
                            <label class="input-group-text" for="last_name">
                                <i class="fa fa-fw {{ trans('forms.create_user_icon_lastname') }}" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    @if ($errors->has('last_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('last_name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">
                {!! Form::label('role', trans('forms.create_user_label_role'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <div class="input-group">
                        <select multiple="multiple" class="form-control" name="role[]" id="role">
                            <option value="">{{ trans('forms.create_user_ph_role') }}</option>
                            @if ($roles)
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        
            <div class="form-group has-feedback row {{ $errors->has('majlis_id') ? ' has-error ' : '' }}">
                <label class="col-md-3 control-label" for="majlis_id">Majlis</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <select multiple="multiple" class="form-control" name="majlis_id[]">
                            <option value="0">Select Majlis</option>
                            @foreach($majlis as $mjl)
                              <option value="{{$mjl->id}}">{{$mjl->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('majlis_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('majlis_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        
            <div class="form-group has-feedback row {{ $errors->has('tanzeem_id') ? ' has-error ' : '' }}">
                <label class="col-md-3 control-label" for="tanzeem_id">Organization</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <select multiple="multiple" class="form-control" name="tanzeem_id[]">
                            <option value="0">Organization (tanzeem)</option>
                            @foreach($tanzeems as $tanzeem)
                              <option value="{{$tanzeem->id}}">{{$tanzeem->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('tanzeem_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tanzeem_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group has-feedback row {{ $errors->has('verify_code') ? ' has-error ' : '' }}">
                {!! Form::label('verify_code', 'AMI Member Code', array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <div class="input-group">
                        {!! Form::text('verify_code', NULL, array('id' => 'verify_code', 'class' => 'form-control', 'placeholder' => 'AMI Member Code')) !!}
                    </div>
                    @if ($errors->has('verify_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('verify_code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
<!--
            <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
                {!! Form::label('password', trans('forms.create_user_label_password'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <div class="input-group">
                        {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'))) !!}
                        <div class="input-group-append">
                            <label class="input-group-text" for="password">
                                <i class="fa fa-fw {{ trans('forms.create_user_icon_password') }}" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">
                {!! Form::label('password_confirmation', trans('forms.create_user_label_pw_confirmation'), array('class' => 'col-md-3 control-label')); !!}
                <div class="col-md-9">
                    <div class="input-group">
                        {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}
                        <div class="input-group-append">
                            <label class="input-group-text" for="password_confirmation">
                                <i class="fa fa-fw {{ trans('forms.create_user_icon_pw_confirmation') }}" aria-hidden="true"></i>
                            </label>
                        </div>
                    </div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
-->
            {!! Form::button(trans('forms.create_user_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
        {!! Form::close() !!}
    </div>
@endsection

@section('footer_scripts')
@endsection
