@extends('layouts.index')

@section('title')
    {{ __('Inbox') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="email-app">
            <div class="mail-list bg-white overflow-auto">
                <div class="p-3 border-bottom">
                    <div class="d-md-flex align-items-center">
                        <div>
                            <h4>{{ __('Messages Inbox') }}</h4>
                            <span>{{ __('Here is the list of messages') }}</span>
                        </div>
                        <div class="ms-auto mt-3 mt-md-0">
                            <input placeholder="Search Mail" id="" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <!-- Action part -->
                <!-- Button group part -->
                <div class="bg-light p-3 d-md-flex align-items-center">
                    <div class="btn-group mt-1 mb-1">
                        <div class="form-check">
                            <input type="checkbox" class="sl-all form-check-input danger check-light-danger" id="cstall">
                            <label class="form-check-label" for="cstall">Check All</label>
                        </div>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group me-2" role="group" aria-label="Button group with nested dropdown">
                            {{-- <button type="button" class="btn btn-outline-secondary fs-5"><i class="mdi mdi-reload"></i></button> --}}
                            {{-- <button type="button" class="btn btn-outline-secondary fs-5"><i class="mdi mdi-alert-octagon"></i></button> --}}
                            <button type="button" class="btn btn-outline-secondary fs-5"><i class="mdi mdi-delete"></i></button>
                        </div>
                        {{-- <div class="btn-group me-2" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-folder fs-5 "></i> </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
                            </div>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-label fs-5"></i> </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1"> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> <a class="dropdown-item" href="javascript:void(0)">Dropdown link</a> </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- Action part -->
                <!-- Mail list-->
                <div class="table-responsive">
                    <table class="table email-table no-wrap table-hover v-middle">
                        <tbody>
                            @foreach ($messages as $message)
                                <tr @if($message->status == '0') class="unread" @endif >
                                    <td class="chb">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="cst1">
                                            <label class="form-check-label" for="cst1">&nbsp;</label>
                                        </div>
                                    </td>
                                    {{-- <td class="starred"><i class="far fa-star"></i></td> --}}
                                    <td class="user-image"><img src="@if ($message->sender->profile && $message->sender->profile->avatar) {{ $message->sender->profile->avatar }} @else {{ asset('assets/images/users/2.jpg') }} @endif" alt="{{ $message->sender->name }} {{ $message->sender->lastname }}" class="rounded-circle" width="30"></td>
                                    <td class="user-name">
                                        <h6 class="mb-0">{{ $message->sender->name }} {{ $message->sender->lastname }}</h6>
                                    </td>
                                    <td class="max-texts text-truncate px-1 py-3 no-wrap"> <a class="link" href="{{ route('messages.view', $message->id) }}">{!! $message->message !!}</a></td>
                                    @if( $message->file_name != null)
                                        <td class="clip"><i class="fa fa-paperclip"></i></td>
                                    @endif
                                    <td class="time"> {{ date("h:i A", strtotime($message->created_at)) }} </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-3 mt-4">
                    {{ $messages->links() }}
                </div>
                {{-- <div class="p-3 mt-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0)">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void(0)">Next</a></li>
                        </ul>
                    </nav>
                </div> --}}
            </div>

        </div>

        @include('layouts/footer')
    </div>
@endsection