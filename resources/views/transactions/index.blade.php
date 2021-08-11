@extends('layouts.index')

@section('title')
    {!! __('All Transactions') !!}
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
                        <h3 class="page-title">Showing All Transactions</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Transactions</li>
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
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $deposit }}</h1>
                                        <h6 class="text-muted">All Deposits</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="20%" class="css-bar mb-0 css-bar-primary css-bar-20"><i class="mdi mdi-account-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $bonus }}</h1>
                                        <h6 class="text-muted">All Bonus</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="30%" class="css-bar mb-0 css-bar-danger css-bar-20"><i class="mdi mdi-briefcase-check"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $purchase }}</h1>
                                        <h6 class="text-muted">All Spent</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="40%" class="css-bar mb-0 css-bar-warning css-bar-40"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $withdrawn }}</h1>
                                        <h6 class="text-muted">All WithDrawn</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="60%" class="css-bar mb-0 css-bar-info css-bar-60"><i class="mdi mdi-receipt"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="border-bottom title-part-padding">
                            <h4 class="card-title mb-0">Transactions</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive users-table">
                                <table id="file_export" class="table table-striped table-bordered display">

                                    <thead class="thead">
                                        <tr>
                                            <th>{!! __('ID') !!}</th>
                                            <th>{!! __('From') !!}</th>
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('Type') !!}</th>
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('Amount') !!}</th>
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('Status') !!}</th>
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('Created') !!}</th>
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('Updated') !!}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="users_table">
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>
                                                    @if($transaction->from != null && $transaction->from != '')
                                                        {{ $transaction->name }} {{ $transaction->lastname }}
                                                    @else
                                                        Null
                                                    @endif
                                                </td>
                                                <td>{{ ucfirst($transaction->type) }}</td>
                                                <td class="hidden-sm hidden-xs hidden-md">
                                                    {{ $transaction->amount }}
                                                </td>
                                                <td class="hidden-sm hidden-xs hidden-md">
                                                    {{ ucfirst($transaction->status) }}
                                                </td>
                                                <td class="hidden-sm hidden-xs hidden-md">{{$transaction->created_at}}</td>
                                                <td class="hidden-sm hidden-xs hidden-md">{{$transaction->updated_at}}</td>
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