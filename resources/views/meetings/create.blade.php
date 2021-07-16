@extends('layouts.index')
@section('title')
    {{ __('messages.new_meeting') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetime-picker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/emojionearea.min.css') }}">
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin_panel.css') }}">
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid page__container">
            <div class="animated fadeIn">
                @include('flash::message')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="pull-left page__heading">
                                    {{ __('messages.new_meeting') }}
                                </div>
                            </div>
                            <div class="card-body">
                                @include('coreui-templates::common.errors')
                                <form method="post" action="{{ route('meetings.store') }}">
                                    {{ csrf_field() }}
                                    <div class="row">
                                    @include('meetings.fields')
                                    </div>
                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection
@section('page_js')
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/admin/meetings/meetings.js') }}"></script>
@endsection
