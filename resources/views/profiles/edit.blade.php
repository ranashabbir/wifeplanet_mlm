@extends('layouts.index')

@section('title')
    {{ __('Edit Profile') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card border-0">
                        <div class="card-body p-0">
                            @if ($user->profile)
                                @if (Auth::user()->id == $user->id || Auth::user()->hasRole('admin'))
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 col-sm-4 col-md-3 profile-sidebar text-white rounded-left-sm-up">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                <a class="nav-link active" data-toggle="pill" href=".edit-profile-tab" role="tab" aria-controls="edit-profile-tab" aria-selected="true">
                                                    {{ __('Profile') }}
                                                </a>
                                                <a class="nav-link" data-toggle="pill" href=".edit-settings-tab" role="tab" aria-controls="edit-settings-tab" aria-selected="false">
                                                    {{ __('Account') }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-8 col-md-9">
                                            <div class="tab-content" id="v-pills-tabContent">
                                                <div class="tab-pane fade show active edit-profile-tab" role="tabpanel" aria-labelledby="edit-profile-tab">
                                                    <div class="row mb-1">
                                                        <div class="col-sm-12">
                                                            <div id="avatar_container">
                                                                <div class="collapseOne card-collapse collapse @if($user->profile->avatar == '') show @endif">
                                                                    <div class="card-body">
                                                                        <img src="{{ Gravatar::get($user->email) }}" alt="{{ $user->name }}" class="user-avatar">
                                                                    </div>
                                                                </div>
                                                                <div class="collapseTwo card-collapse collapse @if($user->profile->avatar != '') show @endif">
                                                                    <div class="card-body">
                                                                        <img id="user_selected_avatar" class="user-avatar" src="@if ($user->profile->avatar != NULL) {{ $user->profile->avatar }} @endif" alt="{{ $user->name }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->id], 'id' => 'user_profile_form', 'class' => 'form-horizontal', 'role' => 'form', 'enctype' => 'multipart/form-data']) !!}
                                                        <div class="row">
                                                            <div class="col-10 offset-1 col-sm-10 offset-sm-1 mb-1">
                                                                <div class="row" data-toggle="buttons">
                                                                    <div class="col-6 col-xs-6 right-btn-container">
                                                                        <label class="btn btn-primary @if($user->profile->avatar == '') active @endif btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne:not(.show), .collapseTwo.show">
                                                                            <input type="radio" name="avatar_status" id="option1" autocomplete="off" value="0" @if($user->profile->avatar_status == 0) checked @endif> Use Gravatar
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-6 col-xs-6 left-btn-container">
                                                                        <label class="btn btn-primary @if($user->profile->avatar != '') active @endif btn-block btn-sm" data-toggle="collapse" data-target=".collapseOne.show, .collapseTwo:not(.show)">
                                                                            <input type="radio" name="avatar_status" id="option2" autocomplete="off" value="1" @if($user->profile->avatar_status == 1) checked @endif> Use My Image
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('avatar') ? ' has-error ' : '' }}">
                                                            {!! Form::label('avatar', __('Avatar') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::file('avatar', array('id' => 'avatar', 'class' => 'form-control', 'placeholder' => __('Avatar'))) !!}
                                                                <span class="glyphicon {{ $errors->has('avatar') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('avatar'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('avatar') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('location') ? ' has-error ' : '' }}">
                                                            {!! Form::label('location', __('Location') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('location', old('location'), array('id' => 'location', 'class' => 'form-control', 'placeholder' => __('Location'))) !!}
                                                                <span class="glyphicon {{ $errors->has('location') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('location'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('location') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('gender') ? ' has-error ' : '' }}">
                                                            {!! Form::label('gender', __('Gender') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::select('gender', array('Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'), old('gender'), array('id' => 'gender', 'class' => 'form-control')) !!}
                                                                <span class="glyphicon {{ $errors->has('gender') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('gender'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('gender') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('age') ? ' has-error ' : '' }}">
                                                            {!! Form::label('age', __('Age') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::number('age', old('age'), array('id' => 'age', 'class' => 'form-control', 'placeholder' => __('Age'))) !!}
                                                                <span class="glyphicon {{ $errors->has('age') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('age'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('age') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('weight') ? ' has-error ' : '' }}">
                                                            {!! Form::label('weight', __('Weight') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::number('weight', old('weight'), array('id' => 'weight', 'class' => 'form-control', 'placeholder' => __('Weight'))) !!}
                                                                <span class="glyphicon {{ $errors->has('weight') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('weight'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('weight') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('height') ? ' has-error ' : '' }}">
                                                            {!! Form::label('height', __('Height') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('height', old('height'), array('id' => 'height', 'class' => 'form-control', 'placeholder' => __('Height'))) !!}
                                                                <span class="glyphicon {{ $errors->has('height') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('height'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('height') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('relationship') ? ' has-error ' : '' }}">
                                                            {!! Form::label('relationship', __('Relationship Status') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::select('relationship', array('Married' => 'Married', 'Widowed' => 'Widowed', 'Separated' => 'Separated', 'Divorced' => 'Divorced', 'Single' => 'Single'), old('relationship'), array('id' => 'relationship', 'class' => 'form-control')) !!}
                                                                <span class="glyphicon {{ $errors->has('relationship') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('relationship'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('relationship') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('hair') ? ' has-error ' : '' }}">
                                                            {!! Form::label('hair', __('Hair') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('hair', old('hair'), array('id' => 'hair', 'class' => 'form-control', 'placeholder' => __('Hair'))) !!}
                                                                <span class="glyphicon {{ $errors->has('hair') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('hair'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('hair') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('occupation') ? ' has-error ' : '' }}">
                                                            {!! Form::label('occupation', __('Occupation') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('occupation', old('occupation'), array('id' => 'occupation', 'class' => 'form-control', 'placeholder' => __('Occupation'))) !!}
                                                                <span class="glyphicon {{ $errors->has('occupation') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('occupation'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('occupation') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('body_type') ? ' has-error ' : '' }}">
                                                            {!! Form::label('body_type', __('Body Type') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::select('body_type',
                                                                    array(
                                                                        'Slender' => 'Slender',
                                                                        'Average' => 'Average',
                                                                        'Toned' => 'Toned',
                                                                        'Athletic' => 'Athletic',
                                                                        'Heavy' => 'Heavy'
                                                                    ),
                                                                    old('body_type'), array('id' => 'body_type', 'class' => 'form-control')) !!}
                                                                <span class="glyphicon {{ $errors->has('body_type') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('body_type'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('body_type') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('children') ? ' has-error ' : '' }}">
                                                            {!! Form::label('children', __('Children') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::select('children',
                                                                    array(
                                                                        'Yes' => 'Yes',
                                                                        'No' => 'No'
                                                                    ),
                                                                    old('children'), array('id' => 'children', 'class' => 'form-control')) !!}
                                                                <span class="glyphicon {{ $errors->has('children') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('children'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('children') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('sports') ? ' has-error ' : '' }}">
                                                            {!! Form::label('sports', __('Sports') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('sports', old('sports'), array('id' => 'sports', 'class' => 'form-control', 'placeholder' => __('Sports'))) !!}
                                                                <span class="glyphicon {{ $errors->has('sports') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('sports'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('sports') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('personality') ? ' has-error ' : '' }}">
                                                            {!! Form::label('personality', __('Personality') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::select('personality',
                                                                    array(
                                                                        'Relaxed' => 'Relaxed',
                                                                        'Less Stressed' => 'Less Stressed',
                                                                        'Flexible' => 'Flexible',
                                                                        'Emotional and Expressive Person' => 'Emotional and Expressive Person',
                                                                        'Laid Back Attitude' => 'Laid Back Attitude',
                                                                        'Procrastinator' => 'Procrastinator',
                                                                        'Casual' => 'Casual',
                                                                        'Easy Going' => 'Easy Going'
                                                                    ),
                                                                    old('personality'), array('id' => 'personality', 'class' => 'form-control')) !!}
                                                                <span class="glyphicon {{ $errors->has('personality') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('personality'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('personality') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('nationality') ? ' has-error ' : '' }}">
                                                            {!! Form::label('nationality', __('Nationality') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('nationality', old('nationality'), array('id' => 'nationality', 'class' => 'form-control', 'placeholder' => __('Nationality'))) !!}
                                                                <span class="glyphicon {{ $errors->has('nationality') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('nationality'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('nationality') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('religion') ? ' has-error ' : '' }}">
                                                            {!! Form::label('religion', __('Religion') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('religion', old('religion'), array('id' => 'religion', 'class' => 'form-control', 'placeholder' => __('Religion'))) !!}
                                                                <span class="glyphicon {{ $errors->has('religion') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('religion'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('religion') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('smoking') ? ' has-error ' : '' }}">
                                                            {!! Form::label('smoking', __('Smoking') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::select('smoking',
                                                                    array(
                                                                        'Yes' => 'Yes',
                                                                        'No' => 'No'
                                                                    ),
                                                                    old('smoking'), array('id' => 'smoking', 'class' => 'form-control')) !!}
                                                                <span class="glyphicon {{ $errors->has('smoking') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('smoking'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('smoking') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('city') ? ' has-error ' : '' }}">
                                                            {!! Form::label('city', __('City') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('city', old('city'), array('id' => 'city', 'class' => 'form-control', 'placeholder' => __('City'))) !!}
                                                                <span class="glyphicon {{ $errors->has('city') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('city'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('city') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('state') ? ' has-error ' : '' }}">
                                                            {!! Form::label('state', __('State') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('state', old('state'), array('id' => 'state', 'class' => 'form-control', 'placeholder' => __('State'))) !!}
                                                                <span class="glyphicon {{ $errors->has('state') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('state'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('state') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-feedback {{ $errors->has('country') ? ' has-error ' : '' }}">
                                                            {!! Form::label('country', __('Country') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::text('country', old('country'), array('id' => 'country', 'class' => 'form-control', 'placeholder' => __('Country'))) !!}
                                                                <span class="glyphicon {{ $errors->has('country') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('country'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('country') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group has-feedback {{ $errors->has('interests') ? ' has-error ' : '' }}">
                                                            {!! Form::label('interests', __('Interests') , array('class' => 'col-12 control-label')); !!}
                                                            <div class="col-12">
                                                                {!! Form::textarea('interests', old('interests'), array('id' => 'interests', 'class' => 'form-control', 'placeholder' => __('Interests'))) !!}
                                                                <span class="glyphicon {{ $errors->has('interests') ? ' glyphicon-asterisk ' : ' glyphicon-pencil ' }} form-control-feedback" aria-hidden="true"></span>
                                                                @if ($errors->has('interests'))
                                                                    <span class="help-block">
                                                                        <strong>{{ $errors->first('interests') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group margin-bottom-2">
                                                            <div class="col-12">
                                                                {!! Form::button(
                                                                    '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . __('Save Profile'),
                                                                    array(
                                                                        'class'             => 'btn btn-success',
                                                                        'type'              => 'submit',
                                                                )) !!}

                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div>

                                                <div class="tab-pane fade edit-settings-tab" role="tabpanel" aria-labelledby="edit-settings-tab">
                                                    {!! Form::model($user, array('action' => array('ProfileController@updateUserAccount', $user->id), 'method' => 'PUT', 'id' => 'user_basics_form')) !!}

                                                        <div class="pt-4 pr-3 pl-2 form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                                            {!! Form::label('name', __('Name'), array('class' => 'col-md-3 control-label')); !!}
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    {!! Form::text('name', $user->name, array('id' => 'name', 'class' => 'form-control', 'placeholder' => __('Name'))) !!}
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

                                                        <div class="pr-3 pl-2 form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                                                            {!! Form::label('email', __('Email'), array('class' => 'col-md-3 control-label')); !!}
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    {!! Form::text('email', $user->email, array('id' => 'email', 'class' => 'form-control', 'placeholder' => __('Email'))) !!}
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

                                                        <div class="pr-3 pl-2 form-group has-feedback row {{ $errors->has('lastname') ? ' has-error ' : '' }}">
                                                            {!! Form::label('lastname', __('Last Name'), array('class' => 'col-md-3 control-label')); !!}
                                                            <div class="col-md-9">
                                                                <div class="input-group">
                                                                    {!! Form::text('lastname', $user->lastname, array('id' => 'lastname', 'class' => 'form-control', 'placeholder' => __('Last Name'))) !!}
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

                                                        <div class="form-group row">
                                                            <div class="col-md-9 offset-md-3">
                                                                {!! Form::button(
                                                                    '<i class="fa fa-fw fa-save" aria-hidden="true"></i> ' . __('Save Account'),
                                                                    array(
                                                                        'class'             => 'btn btn-success',
                                                                        'id'                => 'account_save_trigger',
                                                                        'type'              => 'submit',
                                                                )) !!}
                                                            </div>
                                                        </div>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <p>{{ __('profile.notYourProfile') }}</p>
                                @endif
                            @else
                                <p>{{ __('profile.noProfileYet') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection

@section('scripts')

@endsection
