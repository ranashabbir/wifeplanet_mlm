@extends('layouts.index')

@section('title')
    {!! trans('usersmanagement.create-new-user') !!}
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
                                    {!! Form::label('name', trans('forms.create_user_label_firstname'), array('class' => 'col-md-3 control-label')); !!}
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_firstname'))) !!}
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="name">
                                                    <i class="fa fa-fw {{ trans('forms.create_user_icon_firstname') }}" aria-hidden="true"></i>
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
                                    {!! Form::label('lastname', trans('forms.create_user_label_lastname'), array('class' => 'col-md-3 control-label')); !!}
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            {!! Form::text('lastname', NULL, array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_lastname'))) !!}
                                            <div class="input-group-append">
                                                <label class="input-group-text" for="lastname">
                                                    <i class="fa fa-fw {{ trans('forms.create_user_icon_lastname') }}" aria-hidden="true"></i>
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
            
                                <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">
                                    {!! Form::label('role', trans('forms.create_user_label_role'), array('class' => 'col-md-3 control-label')); !!}
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select class="form-control" name="role" id="role">
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

                                <div class="form-group has-feedback row {{ $errors->has('parent_id') ? ' has-error ' : '' }}">
                    
                                    {!! Form::label('parent_id', __('Parent'), array('class' => 'col-md-3 control-label')); !!}
                    
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select class="form-control" name="parent_id" id="parent_id">
                                                <option value="">{{ __('Select Parent') }}</option>
                                                @if ($parents)
                                                    @foreach($parents as $parent)
                                                        <option value="{{ $parent->id }}" >{{ $parent->name }} {{ $parent->lastname }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @if ($errors->has('parent_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('parent_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group has-feedback row {{ $errors->has('is_active') ? ' has-error ' : '' }}">
                                    {!! Form::label('is_active', __('Is Active?'), array('class' => 'col-md-3 control-label')); !!}
                    
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select class="form-control" name="is_active" id="is_active">
                                                <option value="0">{!! __('No') !!}</option>
                                                <option value="1">{!! __('Yes') !!}</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('is_active'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('is_active') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group has-feedback row {{ $errors->has('email_verified_at') ? ' has-error ' : '' }}">
                                    {!! Form::label('email_verified_at', __('Email Verified?'), array('class' => 'col-md-3 control-label')); !!}
                    
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <select class="form-control" name="email_verified_at" id="email_verified_at">
                                                <option value="0">{!! __('No') !!}</option>
                                                <option value="1">{!! __('Yes') !!}</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('email_verified_at'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email_verified_at') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
            
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
            
                                {!! Form::button(trans('forms.create_user_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
        $('#role').select2();
        $('#parent_id').select2();
        $('#is_active').select2();
        $('#email_verified_at').select2();
    });
</script>
@endsection
