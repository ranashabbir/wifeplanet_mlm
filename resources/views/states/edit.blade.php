@extends('layouts.index')

@section('title')
    {{ __('Edit State') }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
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
                                <i class="fa fa-edit fa-lg"></i>
                                <strong>Edit State</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::model($state, ['route' => ['states.update', $state->id], 'method' => 'patch']) !!}

                                @include('states.fields')

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
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {
            $('#country_id').select2();
        });
    </script>
@endsection