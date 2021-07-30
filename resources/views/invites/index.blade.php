@extends('layouts.index')

@section('title')
    {{ __('Invite New Member') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-sm-12">
                    @include('laravelusers::partials.form-status')
                </div>
                <div class="col-md-5 align-self-center">
                    <h3 class="page-title">Invite New Members</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Invite</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                    <div class="d-flex">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    Invite members
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'invite.invite']) !!}
    
                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" name="email" placeholder="{{ __('Invite your friends to join!') }}"></textarea>
                                        <small id="textHelp" class="form-text text-muted">{{ __('Comma-separated list.') }}</small>
                                    </div>

                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::submit('Invite', ['class' => 'btn btn-primary']) !!}
                                        <a href="{{ url('/home') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
    
                                {!! Form::close() !!}
                            </div>
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