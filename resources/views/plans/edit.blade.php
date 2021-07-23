@extends('layouts.index')
@section('title')
    {{ __('Edit Plan') }}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/ckeditor/samples/css/samples.css') }}">
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

        @include('layouts/footer')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script data-sample="1">
        CKEDITOR.replace('description', {
            height: 150
        });
    </script>
    <script>
        $(document).ready(function() {
            @if ($plan->site == 'dating')
                $('.dating_input-wrap').removeClass('hide');
                $('input[type=submit]').val('Save');
            @else
                $('.dating_input-wrap').addClass('hide');
                $('input[type=submit]').val('Save & Add Bonus');
            @endif

            $('#role_id').select2();
            $("input[name=site]").on("change", function() {
                if ( $(this).val() == 'mlm' ) {
                    $('.dating_input-wrap').addClass('hide');
                    $('input[type=submit]').val('Save & Add Bonus');
                } else {
                    $('.dating_input-wrap').removeClass('hide');
                    $('input[type=submit]').val('Save');
                }
            });
        });
    </script>
@endsection