@extends('layouts.index')

@section('title')
    @isset($id)
        {{ __('Reply Message') }}
    @else
        {{ __('Compose Message') }}
    @endisset
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="email-app">
            <div class="mail-compose bg-white overflow-auto">
                <div class="p-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <div>
                            <h4>
                                @isset($id)
                                    {{ __('Reply Message') }}
                                @else
                                    {{ __('Compose Message') }}
                                @endisset
                            </h4>
                            <span>
                                @isset($id)
                                    {{ __('Reply message to ') }} {{ $message->sender->name }} {{ $message->sender->lastname }}
                                @else
                                    {{ __('Compose new message') }}
                                @endisset
                            </span>
                        </div>
                        <!-- <div class="ms-auto">
                            <button id="cancel_compose" class="btn btn-dark">Back</button>
                        </div> -->
                    </div>
                </div>
                <!-- Action part -->
                <!-- Button group part -->
                <div class="card-body">
                    @php
                        $user_id = null;
                        if( isset($message) ) {
                            $user_id = $message->sender->id;
                        }
                    @endphp
                    @isset( $id )
                        {!! Form::model($message, ['route' => ['messages.update', $message->id]]) !!}
                    @else
                        {!! Form::open(['route' => 'messages.store']) !!}
                    @endisset

                        <div class="mb-3">
                            {!! Form::select('to_id', $users, $user_id, ['id' => 'to_id', 'class' => 'form-control select2']) !!}
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" name="message" id="message" placeholder="Message"></textarea>
                        </div>
                        {{-- <div id="summernote"></div> --}}
                        <h4>Attachment</h4>
                        <div class="mb-3">
                            <input type="file" class="form-control" name="file" id="files" />
                        </div>
                        <div class="button-group text-end">
                            <button type="submit" class="btn btn-success mt-3"><i data-feather="send" class="feather-sm fill-white"></i> Send</button>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#to_id').select2();
        });
    </script>
@endsection