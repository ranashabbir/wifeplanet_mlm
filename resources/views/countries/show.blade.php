@extends('layouts.index')

@section('title')
    {{ __('View Country') }}
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
                                <a href="{{ route('countries.index') }}" class="btn btn-light">Back</a>
                            </div>
                            <div class="card-body">
                                @include('countries.show_fields')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
