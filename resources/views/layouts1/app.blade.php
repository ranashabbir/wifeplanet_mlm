<!DOCTYPE html>
<html>
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('title') | {{ getAppName() }}</title>
    <meta name="description" content="@yield('title') - {{getAppName()}}">
    <meta name="keyword" content="CoreUI,Bootstrap,Admin,Template,InfyOm,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 4.1.3 -->
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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('css')
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{url('/')}}">
        <img class="navbar-brand-full" src="{{ getThumbLogoUrl() }}" width="30" height="30"
             alt="Infyom Logo">
        <img class="navbar-brand-minimized" src="{{ getThumbLogoUrl() }}" width="30"
             height="30" alt="{{config('app.name')}}">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="nav navbar-nav ml-auto">
        {{--<li class="nav-item d-md-down-none">
            <a class="nav-link" href="#">
                <i class="icon-bell"></i>
                <span class="badge badge-pill badge-danger">5</span>
            </a>
        </li>--}}
        <li class="nav-item dropdown notification">
            <a class="nav-link notification__icon" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell"></i>
                <span class="totalNotificationCount" data-total_count="0"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right notification__popup">
                <div class="dropdown-header text-center">
                    <div class="header-heading">
                        <strong>{{__('messages.notifications')}}</strong>
                        <span class="totalNotificationCount" data-total_count="0" style="display: none"></span>
                    </div>
                    <div class="header-button">
                        <a href="#" class="read-all-notification">{{__('messages.read_all')}}</a>
                    </div>
                </div>
                <a class="dropdown-item read" id="noNewNotification">
                    {{__('messages.no_notification_yet')}}
                </a>
            </div>
        </li>
        <li class="dropdown language-menu no-hover mr-3">
            <a href="#" class="dropdown-toggle text-success text-decoration-none"
               data-toggle="dropdown" role="button">
                {{ strtoupper(getCurrentLanguageName()) }}&nbsp;
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" role="menu">
                @foreach(getUserLanguages() as $key => $value)
                    <span class="language-item"><a href="javascript:void(0)"  class="changeLanguage dropdown-item"
                                                   data-prefix-value="{{ $key }}">{{ $value }}</a></span>
                @endforeach
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" style="margin-right: 10px" data-toggle="dropdown" href="#" role="button"
               aria-haspopup="true" aria-expanded="false">
                {{ (htmlspecialchars_decode(Auth::user()->name))??'' }}
                <img class="img-avatar" src="{{Auth::user()->photo_url}}" alt="InfyOm">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header text-center">
                    <strong>{{ __('messages.account') }}</strong>
                </div>
                <a class="dropdown-item" href="{{ url('/profile') }}">
                    <i class="fa fa-user"></i>{{ __('messages.edit_profile') }}</a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePasswordModal"><i
                            class="fa fa-lock"></i>{{ __('messages.change_password') }}</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#setCustomStatusModal">
                    <i class="fa fa-smile-o"></i>{{ __('messages.set_custom_status') }}</a>
                <a class="dropdown-item" class="btn btn-default btn-flat"
                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i>{{ __('messages.logout') }}
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    </ul>
</header>

<div class="app-body">
    @include('layouts1.sidebar')
    @include('layouts1.change_password')
    <main class="main">
        @yield('content')
    </main>
</div>
@include('chat.templates.notification')
@include('partials.file-upload')
@include('partials.set_custom_status_modal')
<footer class="app-footer">
    <div>
        <a href="https://chat.infyom.com/">{{ getAppName() }}</a>
        <span>&copy; 2019 - {{date('Y')}} {{ getCompanyName() }}.</span>
    </div>
    <div class="ml-auto">
        <span>Powered by</span>
        <a href="https://coreui.io">CoreUI</a>
    </div>
</footer>
</body>
<!-- jQuery 3.1.1 -->
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

</html>
