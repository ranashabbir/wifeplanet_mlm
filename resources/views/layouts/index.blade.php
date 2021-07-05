<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Custom CSS -->
    @stack('css')
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/coreui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icheck/skins/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datetime-picker.css') }}"/>

    <link rel="stylesheet" href="{{ asset('assets/css/jquery.toast.min.css') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    @if(Auth::user()->is_subscribed)
        @include('layouts1.one_signal')
    @endif

    @livewireStyles
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/emojionearea.min.css') }}">
    @yield('page_css')
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> --}}
    @yield('css')
</head>
<body>
    <!-- Preloader - style you can find in spinners.css -->
    <div class="preloader">
        <svg class="tea lds-ripple" width="37" height="48" viewbox="0 0 37 48" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M27.0819 17H3.02508C1.91076 17 1.01376 17.9059 1.0485 19.0197C1.15761 22.5177 1.49703 29.7374 2.5 34C4.07125 40.6778 7.18553 44.8868 8.44856 46.3845C8.79051 46.79 9.29799 47 9.82843 47H20.0218C20.639 47 21.2193 46.7159 21.5659 46.2052C22.6765 44.5687 25.2312 40.4282 27.5 34C28.9757 29.8188 29.084 22.4043 29.0441 18.9156C29.0319 17.8436 28.1539 17 27.0819 17Z" stroke="#009efb" stroke-width="2"></path>
          <path d="M29 23.5C29 23.5 34.5 20.5 35.5 25.4999C36.0986 28.4926 34.2033 31.5383 32 32.8713C29.4555 34.4108 28 34 28 34" stroke="#009efb" stroke-width="2"></path>
          <path id="teabag" fill="#009efb" fill-rule="evenodd" clip-rule="evenodd" d="M16 25V17H14V25H12C10.3431 25 9 26.3431 9 28V34C9 35.6569 10.3431 37 12 37H18C19.6569 37 21 35.6569 21 34V28C21 26.3431 19.6569 25 18 25H16ZM11 28C11 27.4477 11.4477 27 12 27H18C18.5523 27 19 27.4477 19 28V34C19 34.5523 18.5523 35 18 35H12C11.4477 35 11 34.5523 11 34V28Z"></path>
          <path id="steamL" d="M17 1C17 1 17 4.5 14 6.5C11 8.5 11 12 11 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" stroke="#009efb"></path>
          <path id="steamR" d="M21 6C21 6 21 8.22727 19 9.5C17 10.7727 17 13 17 13" stroke="#009efb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
    </div>

    <div id="main-wrapper">

        @include('layouts/header')

        @include('layouts/leftbar')

        @yield('content')

    </div>

    <div class="chat-windows"></div>

    @include('chat.templates.notification')
    @include('partials.file-upload')
    @include('partials.set_custom_status_modal')

    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('dist/js/waves.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    
    @stack('script')

    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/coreui.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('assets/icheck/icheck.min.js') }}"></script>
    <script src="https://www.jsviews.com/download/jsviews.min.js"></script>
    <script src="{{ asset('js/emojionearea.js') }}"></script>
    <script src="{{ asset('assets/js/emojione.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datetime-picker.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>

    @yield('page_js')
    <script>
        let setLastSeenURL = '{{url('update-last-seen')}}';
        let pusherKey = '{{ config('broadcasting.connections.pusher.key') }}';
        let pusherCluster = '{{ config('broadcasting.connections.pusher.options.cluster') }}';
        let messageDeleteTime = '{{ config('configurable.delete_message_time') }}';
        let changePasswordURL = '{{ url('change-password') }}';
        let baseURL = '{{ url('/') }}';
        let conversationsURL = '{{ route('conversations') }}';
        let notifications = JSON.parse(JSON.stringify({!! json_encode(getNotifications()) !!}));
        let loggedInUserId = '{{Auth::id()}}';
        let loggedInUserStatus = '{!! Auth::user()->userStatus !!}';
        if (loggedInUserStatus != '') {
            loggedInUserStatus = JSON.parse(JSON.stringify({!! Auth::user()->userStatus !!}));
        }
        let setUserCustomStatusUrl = '{{ route('set-user-status') }}';
        let clearUserCustomStatusUrl = '{{ route('clear-user-status') }}';
        let updateLanguageURL = "{{ url('update-language')}}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });
        (function ($) {
            $.fn.button = function (action) {
                if (action === 'loading' && this.data('loading-text')) {
                    this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
                }
                if (action === 'reset' && this.data('original-text')) {
                    this.html(this.data('original-text')).prop('disabled', false);
                }
            };
        }(jQuery));
    </script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/notification.js') }}"></script>
    <script src="{{ asset('assets/js/set_user_status.js') }}"></script>
    <script src="{{ asset('assets/js/set-user-on-off.js') }}"></script>
    <script src="{{asset('assets/js/profile.js')}}"></script>
    @livewireScripts
    @stack('scripts')
    @yield('scripts')
</body>
</html>
