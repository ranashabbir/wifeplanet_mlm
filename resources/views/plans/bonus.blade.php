@extends('layouts.index')
@section('title')
    {{ __('Edit Plan Bonuses') }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="animated fadeIn">
                {{-- @include('coreui-templates::common.errors') --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    {!! __('Edit Plan Bonuses') !!}
                                    <div class="pull-right">
                                        <a href="{{ url('/bonuses') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="top" title="{{ __('Back to bonuses') }}">
                                            <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                            {!! __('Back to Bonuses') !!}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! Form::model($plan->bonus, ['route' => ['plans.updatebonus', $plan->id]]) !!}
                                    {!! Form::hidden('plan_id', $plan->id) !!}
                                    <!-- Commission Field -->
                                    <div class="form-group col-sm-12 col-lg-12">
                                        {!! Form::label('commission', 'Commission') !!}
                                        {!! Form::number('commission', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Level 1 Field -->
                                    <div class="form-group col-sm-12 col-lg-12">
                                        {!! Form::label('level_1', 'Level 1:') !!}
                                        {!! Form::number('level_1', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Level 2 Field -->
                                    <div class="form-group col-sm-12 col-lg-12">
                                        {!! Form::label('level_2', 'Level 2:') !!}
                                        {!! Form::number('level_2', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Level 3 Field -->
                                    <div class="form-group col-sm-12 col-lg-12">
                                        {!! Form::label('level_3', 'Level 3:') !!}
                                        {!! Form::number('level_3', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Level 4 Field -->
                                    <div class="form-group col-sm-12 col-lg-12">
                                        {!! Form::label('level_4', 'Level 4:') !!}
                                        {!! Form::number('level_4', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Level 5 Field -->
                                    <div class="form-group col-sm-12 col-lg-12">
                                        {!! Form::label('level_5', 'Level 5:') !!}
                                        {!! Form::number('level_5', null, ['class' => 'form-control']) !!}
                                    </div>

                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                        <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancel</a>
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
    <script>
        $(document).ready(function() {
            $('#plan_id').select2();
        });
    </script>
@endsection