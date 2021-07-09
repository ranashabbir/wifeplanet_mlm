@extends('layouts.index')

@section('title')
    {{ __('Create Plan') }}
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
                                    <i class="fa fa-plus-square-o fa-lg"></i>
                                    <strong>Create Plan</strong>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['route' => 'plans.store', 'files' => true]) !!}
    
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