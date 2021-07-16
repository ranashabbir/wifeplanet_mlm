@extends('layouts.index')

@section('title')
    {{ __('View State') }}
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
                                <a href="{{ route('states.index') }}" class="btn btn-light">Back</a>
                            </div>
                            <div class="card-body">
                                @include('states.show_fields')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
