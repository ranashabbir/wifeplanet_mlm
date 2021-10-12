@extends('layouts.index')

@section('title')
    {{ __('My Networks') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-sm-12">
                    @include('laravelusers::partials.form-status')
                </div>
                <div class="col-md-5 align-self-center">
                    <h3 class="page-title">My Networks</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">My Networks</li>
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

            @php
                $countArray = array('one', 'two', 'three', 'four', 'five');
            @endphp

            <div class="animated fadeIn">
                <div id="wrapper">
                    <span class="label first">{{$user->name}}</span>
                    {{-- <div class="branch lv1">
                        @foreach($user->children as $key => $first)
                            <div class="entry {{$countArray[$key]}}">
                                <span class="label">{{$first->name}}</span>
                                @if(count($first->children)>0)
                                <div class="branch lv2">
                                    @foreach ($first->children as $second)
                                        <div class="entry @if(count($second->children) == 1 && !isset($second->children->children)) sole @endif">
                                            <span class="label">{{$second->name}}</span>
                                            @if(count($second->children)>0)
                                            <div class="branch lv3">
                                                @foreach ($second->children as $third)
                                                    <div class="entry {{count($third->children)}} @if(count($third->children) == 1  && !isset($third->children->children)) sole @endif">
                                                        <span class="label">{{$third->name}}</span>
                                                        @if(count($third->children)>0)
                                                        <div class="branch lv4">
                                                            @foreach ($third->children as $forth)
                                                                <div class="entry"><span class="label">{{$forth->name}}</span></div>
                                                            @endforeach
                                                        </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div> --}}
                    <div class="branch lv1">
                        <div class="entry one"><span class="label">Entry-1</span>
                            <div class="branch lv2">
                                <div class="entry"><span class="label">Entry-1-1</span>
                                    <div class="branch lv3">
                                        <div class="entry sole"><span class="label">Entry-1-1-1</span></div>
                                    </div>
                                </div>
                                <div class="entry"><span class="label">Entry-1-2</span>
                                    <div class="branch lv3">
                                        <div class="entry sole"><span class="label">Entry-1-2-1</span></div>
                                    </div>
                                </div>
                                <div class="entry"><span class="label">Entry-1-3</span>
                                    <div class="branch lv3">
                                        <div class="entry sole"><span class="label">Entry-1-3-1</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="entry two"><span class="label">Entry-2</span></div>
                        <div class="entry two"><span class="label">Entry-3</span>
                            <div class="branch lv2">
                                <div class="entry"><span class="label">Entry-3-1</span></div>
                                <div class="entry"><span class="label">Entry-3-2</span></div>
                                <div class="entry"><span class="label">Entry-3-3</span>
                                    <div class="branch lv3">
                                        <div class="entry"><span class="label">Entry-3-3-1</span></div>
                                        <div class="entry"><span class="label">Entry-3-3-2</span>
                                            <div class="branch lv4">
                                                <div class="entry"><span class="label">Entry-3-3-2-1</span></div>
                                                <div class="entry"><span class="label">Entry-3-3-2-2</span></div>
                                            </div>
                                        </div>
                                        <div class="entry"><span class="label">Entry-3-3-3</span></div>
                                    </div>
                                </div>
                                <div class="entry"><span class="label">Entry-3-4</span></div>
                            </div>
                        </div>
                        <div class="entry three"><span class="label">Entry-4</span></div>
                        <div class="entry three"><span class="label">Entry-5</span></div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection

@section('scripts')
@endsection