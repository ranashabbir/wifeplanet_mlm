@extends('layouts.index')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/dist/apexcharts.css') }}">
    <link href="{{ asset('assets/extra-libs/css-chart/css-chart.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">{{ __('Dashboard') }}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if (Auth::user()->hasRole('admin'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $newusers }}</h1>
                                        <h6 class="text-muted">New Users</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="20%" class="css-bar mb-0 css-bar-primary css-bar-20"><i class="mdi mdi-account-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $upgrades }}</h1>
                                        <h6 class="text-muted">Upgrades</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="30%" class="css-bar mb-0 css-bar-danger css-bar-20"><i class="mdi mdi-briefcase-check"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $freeuser }}</h1>
                                        <h6 class="text-muted">Free Members</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="40%" class="css-bar mb-0 css-bar-warning css-bar-40"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $freepackage }}</h1>
                                        <h6 class="text-muted">Free Package Users</h6></div>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Profiles to approve</h4>
                        </div>

                        <div class="comment-widgets scrollable position-relative mb-2" >
                            @if (count($forapproval)>0)
                                @foreach ($forapproval as $item)
                                    <div class="d-flex flex-row comment-row p-2 p-md-3">
                                        <div class="p-1 p-md-2"><a href="{{ route('profile.show', [$item->id]) }}"><span class="round text-white d-inline-block text-center"><img src="@if($item->profile && $item->profile->avatar) {{ $item->profile->avatar }} @else {{ asset('assets/images/users/1.jpg') }} @endif" alt="user" width="50" class="rounded-circle"></span></a></div>
                                        <div class="comment-text w-100 py-1 py-md-3 pr-md-3 pl-md-4 px-2">
                                            <h5 class="font-weight-medium"><a href="{{ route('profile.show', [$item->id]) }}">{{ $item->name }} {{ $item->lastname }}</a></h5>
                                            <p class="mb-1 fs-3 fw-light text-muted" style="display:inline-block;">{{ $item->email }}</p>
                                            <p style="display:inline-block;float:right;">
                                                <a href="{{ route('users.approve', $item->id) }}" title="{{ __('Approve') }}" class="btn btn-sm btn-success"><i data-feather="check" class="feather-icon"></i></a>
                                            </p>
                                            <div class="comment-footer d-md-flex align-items-center mt-2">                                            
                                                <span class="badge bg-light-info text-info">Pending</span>
                                                <span class="text-muted ms-auto d-block text-end fs-2 fw-normal">{{ date('j F, Y', strtotime($item->created_at)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        {{ __('No profiles to approve yet.') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <h3>Cash Flow</h3>
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $withdrawn }}</h1>
                                        <h6 class="text-muted">Total Withdrawn</h6>
                                    </div>
                                    <div class="clear-both"></div>
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
                                        <h1 class="fw-light">{{ $purchase }}</h1>
                                        <h6 class="text-muted">Total Purchase</h6>
                                    </div>
                                    <div class="clear-both"></div>
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
                                        <h1 class="fw-light">{{ $bonus }}</h1>
                                        <h6 class="text-muted">Total Bonus</h6>
                                    </div>
                                    <div class="clear-both"></div>
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
                                        <h1 class="fw-light">{{ $deposit }}</h1>
                                        <h6 class="text-muted">Total Deposit</h6>
                                    </div>
                                    <div class="clear-both"></div>
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
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Customers</h4>
                        </div>

                        <div class="comment-widgets scrollable position-relative mb-2" >
                            @if (count($customer)>0)
                                @foreach ($customer as $item)
                                    <div class="d-flex flex-row comment-row p-2 p-md-3">
                                        <div class="p-1 p-md-2"><span class="round text-white d-inline-block text-center"><img src="@if($item->profile && $item->profile->avatar) {{ $item->profile->avatar }} @else {{ asset('assets/images/users/1.jpg') }} @endif" alt="user" width="50" class="rounded-circle"></span></div>
                                        <div class="comment-text w-100 py-1 py-md-3 pr-md-3 pl-md-4 px-2">
                                            <h5 class="font-weight-medium">{{ $item->name }} {{ $item->lastname }}</h5>
                                            <p class="mb-1 fs-3 fw-light text-muted">Parent {{ $item->parent->name }}</p>
                                            <div class="comment-footer d-md-flex align-items-center mt-2">
                                                <span class="text-muted ms-auto d-block text-end fs-2 fw-normal">{{ date('j F, Y', strtotime($item->created_at)) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        {{ __('You have no customers yet.') }} <a href="{{ url('/registeruser') }}" class="btn btn-sm btn-default" style="float: right;">{{ __('Register User') }}</a>
                                    </div>
                                </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">My Titles</h4>
                        </div>

                        <div class="comment-widgets scrollable position-relative mb-2" >
                            @if (count($customer)>0)
                                @foreach ($titles as $item)
                                    <div class="d-flex flex-row comment-row p-2 p-md-3">
                                        <div class="comment-text w-100 py-1 py-md-3 pr-md-3 pl-md-4 px-2">
                                            <h5 class="font-weight-medium">{{ $item->f_name }} {{ $item->l_name }}</h5>
                                            <p class="mb-1 fs-3 fw-light text-muted">{{ $item->title_name }}</p>
                                            <div class="comment-footer d-md-flex align-items-center mt-2"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="card-body">
                                    <div class="alert alert-warning">
                                        {{ __('You have no titles yet.') }} <a href="{{ url('/titles') }}" class="btn btn-sm btn-default" style="float: right;">{{ __('View All') }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @include('layouts/footer')
</div>
@endsection

@push('script')
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard5.js') }}"></script>
@endpush