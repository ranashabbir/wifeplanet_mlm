@extends('layouts.index')

@section('title')
    {!! __('usersmanagement.editing-user', ['name' => $user->name]) !!}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    {!! __('usersmanagement.editing-user', ['name' => $user->name]) !!}
                    <div class="pull-right">
                        <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ __('usersmanagement.tooltips.back-users') }}">
                            <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                            {!! __('usersmanagement.buttons.back-to-users') !!}
                        </a>
                        <a href="{{ url('/users/' . $user->id) }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ __('usersmanagement.tooltips.back-users') }}">
                            <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                            {!! __('usersmanagement.buttons.back-to-user') !!}
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!! Form::open(array('route' => ['users.update', $user->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}
        
                    {!! csrf_field() !!}
        
                    <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                        {!! Form::label('name', __('forms.create_user_label_username'), array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('name', $user->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => __('forms.create_user_ph_username'))) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="name">
                                        <i class="fa fa-fw {{ __('forms.create_user_icon_username') }}" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if($errors->has('name'))
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
                                {!! Form::text('lastname', $user->lastname, array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => __('forms.create_user_ph_lastname'))) !!}
                                <div class="input-group-append">
                                    <label class="input-group-text" for="last_name">
                                        <i class="fa fa-fw {{ __('forms.create_user_icon_lastname') }}" aria-hidden="true"></i>
                                    </label>
                                </div>
                            </div>
                            @if($errors->has('lastname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
        
                    <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                        {!! Form::label('email', __('forms.create_user_label_email'), array('class' => 'col-md-3 control-label')); !!}
                        <div class="col-md-9">
                            <div class="input-group">
                                {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' => __('forms.create_user_ph_email'))) !!}
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
        
                    <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">
        
                        {!! Form::label('role', __('forms.create_user_label_role'), array('class' => 'col-md-3 control-label')); !!}
        
                        <div class="col-md-9">
                            <div class="input-group">
                                <select class="form-control" name="role" id="role">
                                    <option value="">{{ __('forms.create_user_ph_role') }}</option>
                                    @if ($roles)
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}"   selected="selected" >{{ $role->name }}</option>
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

                    <div class="pw-change-container">
                        <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">
        
                            {!! Form::label('password', __('forms.create_user_label_password'), array('class' => 'col-md-3 control-label')); !!}
        
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => __('forms.create_user_ph_password'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="password">
                                            <i class="fa fa-fw {{ __('forms.create_user_icon_password') }}" aria-hidden="true"></i>
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
        
                            {!! Form::label('password_confirmation', __('forms.create_user_label_pw_confirmation'), array('class' => 'col-md-3 control-label')); !!}
        
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => __('forms.create_user_ph_pw_confirmation'))) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="password_confirmation">
                                            <i class="fa fa-fw {{ __('forms.create_user_icon_pw_confirmation') }}" aria-hidden="true"></i>
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
                    </div>

                    <div class="row">
        <!--
                        <div class="col-12 col-sm-6 mb-2">
                            <a href="#" class="btn btn-outline-secondary btn-block btn-change-pw mt-3" title="{{ __('forms.change-pw')}} ">
                                <i class="fa fa-fw fa-lock" aria-hidden="true"></i>
                                <span></span> {!! __('forms.change-pw') !!}
                            </a>
                        </div>
        -->
                        <div class="col-12 col-sm-12">
                            <button class="btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save" type="submit" ><i class="fa fa-fw fa-save" aria-hidden="true"></i> Save Changes</button>
                            {{--!! Form::button(__('forms.save-changes'), array('class' => 'btn btn-success btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => __('modals.edit_user__modal_text_confirm_title'), 'data-message' => __('modals.edit_user__modal_text_confirm_message'))) !!--}}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
    {{-- @include('modals.modal-save') --}}
@endsection

@section('scripts')
  {{-- @include('scripts.delete-modal-script') --}}
  {{--@include('scripts.save-modal-script')--}}
  {{-- @include('scripts.check-changed') --}}
@endsection
