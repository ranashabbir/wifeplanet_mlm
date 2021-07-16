@extends('layouts.index')

@section('title')
    {{ __('Edit Country') }}
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
                                <strong>Edit Country</strong>
                            </div>
                            <div class="card-body">
                                {!! Form::model($country, ['route' => ['countries.update', $country->id], 'method' => 'patch']) !!}

                                @include('countries.fields')

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection