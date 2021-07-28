@extends('layouts.index')

@section('title')
    {{ __('Packages') }}
@endsection

@section('css')
    <link href="{{ asset('assets/libs/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-wrapper">
{{-- 
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-md-5 align-self-center">
                    <h3 class="page-title">Eco Products</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Eco Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-md-7 justify-content-end align-self-center d-none d-md-flex">
                    <div class="d-flex">
                        <div class="dropdown me-2">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            January 2021
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">February 2021</a></li>
                            <li><a class="dropdown-item" href="#">March 2021</a></li>
                            <li><a class="dropdown-item" href="#">April 2021</a></li>
                          </ul>
                        </div>
                        <button class="btn btn-success"><i data-feather="plus" class="fill-white feather-sm"></i> Create</button>
                    </div>
                </div>
            </div>
        </div>
 --}}

        <div class="container-fluid">
            <div class="row el-element-overlay">
                @foreach($plans as $plan)
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="el-card-item pb-3">
                                <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center"> <img src="../assets/images/gallery/chair.jpg" class="d-block position-relative w-100" alt="user" />
                                    <div class="el-overlay w-100 overflow-hidden">
                                        <ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">
                                            <li class="el-item d-inline-block my-0  mx-1"><a class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white" href="../assets/images/gallery/chair.jpg"><i class="icon-magnifier"></i></a></li>
                                            <li class="el-item d-inline-block my-0  mx-1"><a class="btn default btn-outline el-link text-white border-white" href="javascript:void(0);"><i class="icon-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-flex no-block align-items-center">
                                    <div class="ms-3">
                                        <h4 class="mb-0">{{ $plan->title }}</h4>
                                        <span class="text-muted">{!! $plan->description !!}</span>
                                    </div>
                                    <div class="ms-auto me-3">
                                        <button type="button" class="btn btn-dark btn-circle">${{ $plan->price }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/libs/magnific-popup/meg.init.js') }}"></script>
@endsection