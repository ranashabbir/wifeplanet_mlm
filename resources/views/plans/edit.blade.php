@extends('layouts.index')
@section('title')
    {{ __('Edit Plan') }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/ckeditor/samples/css/samples.css') }}">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    {!! __('Edit Plan') !!}
                                    <div class="pull-right">
                                        <a href="{{ url('/plans') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ __('Back to plans') }}">
                                            <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                            {!! __('Back to Plans') !!}
                                        </a>
                                        <a href="{{ url('/plans/' . $plan->id) }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ __('Back to plan') }}">
                                            <i class="fa fa-fw fa-reply" aria-hidden="true"></i>
                                            {!! __('Back to Plan') !!}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::model($plan, ['route' => ['plans.update', $plan->id], 'method' => 'patch', 'files' => true]) !!}
    
                                @include('plans.fields')
    
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script data-sample="1">
        CKEDITOR.replace('description', {
            height: 150
        });
    </script>
@endsection