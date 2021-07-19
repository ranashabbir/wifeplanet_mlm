@extends('layouts.index')

@section('title')
    {{ __('View Message') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="email-app">
            <div class="mail-details bg-white overflow-auto">
                <div class="card-body bg-light">
                    <div class="btn-group me-2" role="group" aria-label="Button group with nested dropdown">
                        <a href="{{ route('messages.reply', $message->id) }}" class="btn btn-outline-secondary fs-5"><i class="mdi mdi-reply"></i></a>
                        {{-- <button type="button" class="btn btn-outline-secondary fs-5"><i class="mdi mdi-alert-octagon"></i></button> --}}
                        <a href="{{ route('messages.delete', $message->id) }}" class="btn btn-outline-secondary fs-5"><i class="mdi mdi-delete"></i></a>
                    </div>
                    {{-- <div class="btn-group me-2" role="group" aria-label="Button group with nested dropdown">
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-folder fs-5 "></i> </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
                        </div>
                        <div class="btn-group" role="group">
                            <button id="btnGroupDrop2" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-label fs-5"></i> </button>
                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop2"> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
                        </div>
                    </div> --}}
                </div>
                <div class="card-body border-bottom">
                    <h4 class="mb-0">@if( strpos($message->message, 'emojione') !== false ) {!! $message->message !!} @else {!! \Illuminate\Support\Str::limit($message->message, 50, $end='...') !!} @endif</h4>
                </div>
                <div class="card-body border-bottom">
                    <div class="d-flex no-block align-items-center mb-5">
                        <div class="me-2"><img src="@if ($message->sender->profile && $message->sender->profile->avatar) {{ $message->sender->profile->avatar }} @else {{ asset('assets/images/users/2.jpg') }} @endif" alt="{{ $message->sender->name }} {{ $message->sender->lastname }}" class="rounded-circle" width="45"></div>
                        <div class="">
                            <h5 class="mb-0 fs-4 font-weight-medium">{{ $message->sender->name }} {{ $message->sender->lastname }} <small> ( {{ $message->sender->email }} )</small></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-11">
                            <p>{!! $message->message !!}</p>
                        </div>
                    </div>
                </div>
                @if( $message->file_name != null)
                <div class="card-body">
                    <h4><i class="fa fa-paperclip me-2 mb-2"></i> Attachments</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="javascript:void(0)"> <img class="img-thumbnail img-responsive" alt="attachment" src="@if ($message->file_name) {{ $message->file_name }} @else {{ asset('assets/images/users/2.jpg') }} @endif"> </a>
                        </div>
                    </div>
                    <div class="border mt-3 p-3">
                        <p class="pb-3">click here to <a href="{{ route('messages.compose') }}">Reply</a></p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection