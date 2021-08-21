@extends('layouts.index')

@section('title')
    {{ __('My Titles') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-sm-12">
                    @include('laravelusers::partials.form-status')
                </div>
                <div class="col-md-5 align-self-center">
                    <h3 class="page-title">My Titles</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Titles</li>
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
        <div class="container-fluid">
            <div class="animated fadeIn">
                <div class="row">
                    @php
                        $colors = array('primary', 'success', 'warning');
                    @endphp
                    @foreach ($user->titles as $i => $item)
                        <div class="col-md-4 col-xl-2 d-flex align-items-stretch">
                            <div class="card w-100">
                                <div class="card-header bg-{{ $colors[$i] }}">
                                    <h4 class="mb-0 text-white">{{ $item->title->name }}</h4>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">
                                        {{ $item->title->total_invite }}
                                        @if ($item->title->type == 'team')
                                            Users Invited
                                        @elseif($item->title->type == 'executive')
                                            User Becomes Team Leader
                                        @else
                                            Team Leader Becomes Executive
                                        @endif
                                    </h3>
                                    <p class="card-text">{{ $item->title->description }}</p>
                                    <ul class="list-group">
                                        @if ($item->title->type == 'team')
                                            <li class="list-group-item">All team leaders share 10% of all no parent users at the dating site.</li>
                                            <li class="list-group-item">This sharing is done by system once a month.</li>
                                        @elseif($item->title->type == 'executive')
                                            <li class="list-group-item">All executive leaders share 10% of all no parent users at the dating site.</li>
                                            <li class="list-group-item">This sharing is done by system once a month.</li>
                                        @else
                                            <li class="list-group-item">All corporate leaders share 10% of all no parent users at the dating site.</li>
                                            <li class="list-group-item">This sharing is done by system once a month.</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection

@section('scripts')

@endsection