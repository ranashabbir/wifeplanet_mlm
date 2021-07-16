@extends('layouts.index')
@section('title')
    {{ __('messages.meetings') }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTable.min.css') }}"/>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/admin_panel.css') }}">
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="container-fluid page__container meetings-container">
            <div class="animated fadeIn">
                @include('flash::message')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header page-header">
                                <div class="pull-left page__heading">
                                    {{ __('messages.meetings') }}
                                </div>
                                <div class="filter-container">
                                    <a href="{{ route('meetings.create') }}" class="pull-right btn btn-primary">{{ __('messages.new_meeting') }}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('meetings.table')
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
        let createMeetingUrl = "{{ route('meetings.store') }}";
        let meetingsUrl = "{{ route('meetings.index') }}";
        let defaultImageAvatar = "{{ getDefaultAvatar() }}/";
    </script>
    <script src="{{ asset('assets/js/admin/meetings/meetings.js') }}"></script>
    <script src="{{ asset('assets/js/admin/meetings/meeting_index.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/custom-datatables.js') }}"></script>
@endsection

