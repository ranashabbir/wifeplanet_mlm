@extends('layouts.index')

@section('title')
    {{ __('Packages') }}
@endsection

@section('css')
    <link href="{{ asset('assets/libs/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-wrapper">
        @include('flash::message')
        <div class="container-fluid">
            <div class="row el-element-overlay">
                @foreach($plans as $plan)
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="el-card-item pb-3">
                                <div class="el-card-avatar mb-3 el-overlay-1 w-100 overflow-hidden position-relative text-center">
                                    @if(!empty($subscription) && $subscription->plan_id == $plan->id)
                                        <div class="btn btn-success btn-block w-100">Current Package</div>
                                    @endif
                                    <img src="@if($plan->image != null) {{ Storage::url('plans/'.$plan->id.'/'.$plan->image) }} @else {{ asset('assets/images/gallery/chair.jpg') }} @endif" class="d-block position-relative w-100" alt="user" />
                                    <div class="el-overlay w-100 overflow-hidden">
                                        <ul class="list-style-none el-info text-white text-uppercase d-inline-block p-0">
                                            <li class="el-item d-inline-block my-0  mx-1"><a class="btn default btn-outline image-popup-vertical-fit el-link text-white border-white" href="@if($plan->image != null) {{ Storage::url('plans/'.$plan->id.'/'.$plan->image) }} @else {{ asset('assets/images/gallery/chair.jpg') }} @endif"><i class="icon-magnifier"></i></a></li>
                                            <li class="el-item d-inline-block my-0  mx-1"><a class="btn default btn-outline el-link text-white border-white" href="{{ route('purchase.package', $plan->id) }}"><i class="icon-link"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="d-flex no-block align-items-center">
                                    <div class="ms-3">
                                        <h4 class="mb-0"><a href="{{ route('purchase.package', $plan->id) }}">{{ $plan->title }}</a></h4>
                                        <span class="text-muted">{!! Illuminate\Support\Str::limit($plan->description, 100) !!}</span>
                                    </div>
                                    <div class="ms-auto me-3">
                                        <a href="{{ route('purchase.package', $plan->id) }}"><button type="button" class="btn btn-dark btn-circle" style="width: 50px; height: 50px;">${{ $plan->price }}</button></a>
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