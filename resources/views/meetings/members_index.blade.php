@extends('layouts.index')
@section('title')
    {{ __('messages.meetings') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetime-picker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/emojionearea.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTable.min.css') }}"/>
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
                            <div class="card-header page-header">
                                <div class="pull-left page__heading">
                                    {{ __('messages.meetings') }}
                                </div>
                            </div>
                            <div class="card-body">
                                @include('meetings.member_table')
                                <div class="pull-right mr-3">
    
                                </div>
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
    <script type="text/javascript" src="{{ asset('js/dataTable.min.js') }}"></script>
@endsection
@section('scripts')
    <script>
        let meetingsUrl = "{{ route('meetings.member_index') }}";
    </script>
    <script src="{{ asset('assets/js/admin/meetings/member_meeting_index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/custom-datatables.js') }}"></script>
@endsection

