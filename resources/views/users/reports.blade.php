@extends('layouts.index')

@section('title')
    {!! __('All Reports') !!}
@endsection

@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-wrapper">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-sm-12">
                        @include('laravelusers::partials.form-status')
                    </div>
                    <div class="col-md-5 align-self-center">
                        <h3 class="page-title">Showing All Reports</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Reports</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                        <div class="d-flex">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="border-bottom title-part-padding">
                            <h4 class="card-title mb-0">Reports</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive users-table">
                                <table id="file_export" class="table table-striped table-bordered display">

                                    <thead class="thead">
                                        <tr>
                                            <th>{!! __('ID') !!}</th>
                                            <th>{!! __('Message') !!}</th>
                                            <th>{!! __('Reported User') !!}</th>
                                            <th>{!! __('Reported By') !!}</th>
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('Created') !!}</th>
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('Updated') !!}</th>
                                            <th width="90px;" class="no-search no-sort hidden-sm hidden-xs hidden-md">{!! __('Actions') !!}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="users_table">
                                        @foreach($reports as $report)
                                            <tr>
                                                <td>{{ $report->id }}</td>
                                                <td>{!! $report->message !!}</td>
                                                <td><a href="{{ url('/profile/'.$report->user_id) }}">{{ $report->u_fname }} {{ $report->u_lname }}</a></td>
                                                <td><a href="{{ url('/profile/'.$report->reported_by) }}">{{ $report->r_fname }} {{ $report->r_lname }}</a></td>
                                                <td class="hidden-sm hidden-xs hidden-md">{{$report->created_at}}</td>
                                                <td class="hidden-sm hidden-xs hidden-md">{{$report->updated_at}}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-danger" href="{{ URL::to('blockusers/' . $report->user_id) }}" data-toggle="tooltip" title="{!! __('Block User') !!}">
                                                        {!! __('Block User') !!}
                                                    </a> 
                                                    <a class="btn btn-sm btn-success" href="{{ URL::to('deletereport/' . $report->id) }}" data-toggle="tooltip" title="{!! __('Delete Request') !!}">
                                                        {!! __('Delete Request') !!}
                                                    </a> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

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

    <script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/custom-datatable.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
@endsection