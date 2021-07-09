@extends('layouts.index')
@section('title')
    {{ __('Create Plan') }}
@endsection
@section('page_css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTable.min.css') }}"/>
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/admin_panel.css') }}"> --}}
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
                                <strong>Details</strong>
                                <a href="{{ route('plans.index') }}" class="btn btn-light">Back</a>
                            </div>
                            <div class="card-body">
                                @include('plans.show_fields')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
