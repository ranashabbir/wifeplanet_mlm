<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">

            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

            <a class="navbar-brand" href="{{ url('/home') }}" style="color: #009efb;">

                <b class="logo-icon">
                    <!-- {{ config('app.name', 'Laravel') }} -->
                    <img class="logo-sidebar" src="{{ asset('assets/images/logo2.png') }}" alt="logo" />
                    <!--
                    <img src="{{-- asset('assets/images/logo-icon.png') --}}" alt="homepage" class="dark-logo" />

                    <img src="{{-- asset('assets/images/logo-light-icon.png') --}}" alt="homepage" class="light-logo" />
                    -->
                </b>

                <span class="logo-text">
                    {{-- {{ __('Admin') }} --}}
                    <!--
                    <img src="{{-- asset('assets/images/logo-text.png') --}}" alt="homepage" class="dark-logo" />
 
                    <img src="{{-- asset('assets/images/logo-light-text.png') --}}" class="light-logo" alt="homepage" />
                    -->
                </span>
            </a>

            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>

        <div class="navbar-collapse collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="icon-arrow-left-circle"></i></a></li>

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark"  href="#" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-start mailbox dropdown-menu-animate-up">
                        <ul class="list-style-none">
                            <li>
                                <div class="border-bottom rounded-top py-3 px-4">
                                    <div class="mb-0 font-weight-medium fs-4">Notifications</div>
                                </div>
                            </li>
                            <li>
                                <div class="message-center notifications position-relative"
                                    style="height:230px;">

                                    <a href="javascript:void(0)"
                                        class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="btn btn-light-danger text-danger btn-circle">
                                            <i data-feather="link" class="feather-sm fill-white"></i>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Luanch Admin</h5> <span
                                                class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">Just see
                                                the my new admin!</span> <span
                                                class="fs-2 text-nowrap d-block subtext text-muted">9:30 AM</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)"
                                        class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="btn btn-light-success text-success btn-circle">
                                            <i data-feather="calendar" class="feather-sm fill-white"></i>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Event today</h5> <span
                                                class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">Just a
                                                reminder that you have event</span> <span
                                                class="fs-2 text-nowrap d-block subtext text-muted">9:10 AM</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)"
                                        class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="btn btn-light-info text-info btn-circle">
                                            <i data-feather="settings" class="feather-sm fill-white"></i>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Settings</h5> <span
                                                class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">You can
                                                customize this template as you want</span> <span
                                                class="fs-2 text-nowrap d-block subtext text-muted">9:08 AM</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)"
                                        class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="btn btn-light-primary text-primary btn-circle">
                                            <i data-feather="users" class="feather-sm fill-white"></i>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Pavan kumar</h5> <span
                                                class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">Just see
                                                the my admin!</span> <span
                                                class="fs-2 text-nowrap d-block subtext text-muted">9:02 AM</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="nav-link border-top text-center text-dark pt-3"
                                    href="javascript:void(0);"> <strong>Check all notifications</strong> <i
                                        class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li> -->

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                            class="mdi mdi-email"></i>
                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                    </a>
                    <div class="dropdown-menu mailbox dropdown-menu-start dropdown-menu-animate-up"
                        aria-labelledby="2">
                        <ul class="list-style-none">
                            <li>
                                <div class="border-bottom rounded-top py-3 px-4">
                                    <div class="mb-0 font-weight-medium fs-4">You have 4 new messages</div>
                                </div>
                            </li>
                            <li>
                                <div class="message-center message-body position-relative"
                                    style="height:230px;">

                                    <a href="javascript:void(0)"
                                        class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="user-img position-relative d-inline-block"> <img
                                                src="{{ asset('assets/images/users/1.jpg') }}" alt="user"
                                                class="rounded-circle w-100"> <span
                                                class="profile-status rounded-circle online"></span> </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Pavan kumar</h5> <span
                                                class="fs-2 text-nowrap d-block time text-truncate fw-normal mt-1">Just see
                                                the my admin!</span> <span
                                                class="fs-2 text-nowrap d-block subtext text-muted">9:30 AM</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)"
                                        class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="user-img position-relative d-inline-block"> <img
                                                src="{{ asset('assets/images/users/2.jpg') }}" alt="user"
                                                class="rounded-circle w-100"> <span
                                                class="profile-status rounded-circle busy"></span> </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Sonu Nigam</h5> <span
                                                class="fs-2 text-nowrap d-block time text-truncate">I've sung
                                                a song! See you at</span> <span
                                                class="fs-2 text-nowrap d-block subtext text-muted">9:10 AM</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)"
                                        class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="user-img position-relative d-inline-block"> <img
                                                src="{{ asset('assets/images/users/3.jpg') }}" alt="user"
                                                class="rounded-circle w-100"> <span
                                                class="profile-status rounded-circle away"></span> </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Arijit Sinh</h5> <span
                                                class="fs-2 text-nowrap d-block time text-truncate">I am a
                                                singer!</span> <span
                                                class="fs-2 text-nowrap d-block subtext text-muted">9:08 AM</span>
                                        </div>
                                    </a>

                                    <a href="javascript:void(0)"
                                        class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                        <span class="user-img position-relative d-inline-block"> <img
                                                src="{{ asset('assets/images/users/4.jpg') }}" alt="user"
                                                class="rounded-circle w-100"> <span
                                                class="profile-status rounded-circle offline"></span> </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h5 class="message-title mb-0 mt-1 fs-3 fw-bold">Pavan kumar</h5> <span
                                                class="fs-2 text-nowrap d-block time text-truncate">Just see
                                                the my admin!</span> <span
                                                class="fs-2 text-nowrap d-block subtext text-muted">9:02 AM</span>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="nav-link border-top text-center text-dark pt-3"
                                    href="javascript:void(0);"> <b>See all e-Mails</b> <i
                                        class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </div>
                </li> -->



            </ul>

            <ul class="navbar-nav">

                <li class="nav-item search-box d-none d-md-block">
                    <form class="app-search mt-3 me-2">
                        <input type="text" class="form-control rounded-pill border-0" placeholder="Search for..."> 
                        <a class="srh-btn"><i data-feather="search" class="feather-sm fill-white mt-n1"></i></a> 
                    </form>
                </li>

                
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            {{-- onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" --}}
                                            >
                                {{ __('Logout') }}
                            </a>

                            {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form> --}}
                        </div>
                    </li>
                
                <li class="nav-item dropdown">
                    @guest
                        @if (Route::has('login'))
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @endif

                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <!-- <img src="@if(Auth::user()->profile && Auth::user()->profile->avatar) {{ Auth::user()->profile->avatar }} @else {{ asset('assets/images/users/5.jpg') }} @endif" alt="user" width="30" class="profile-pic rounded-circle" /> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-end user-dd animated flipInY">
                            <div class="d-flex no-block align-items-center p-3 bg-info text-white mb-2">
                                <div class=""><img src="@if(Auth::user()->profile && Auth::user()->profile->avatar) {{ Auth::user()->profile->avatar }} @else {{ asset('assets/images/users/5.jpg') }} @endif" alt="user" class="rounded-circle" width="60"></div>
                                <div class="ms-2">
                                    <h4 class="mb-0 text-white">{{ Auth::user()->name }}</h4>
                                    <p class=" mb-0">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('profile.show', [Auth::user()->id]) }}"><i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My
                                Profile</a>
                            <a class="dropdown-item" href="#"><i data-feather="credit-card" class="feather-sm text-info me-1 ms-1"></i>
                                My Balance</a>
                            <a class="dropdown-item" href="{{ url('/messages/inbox') }}"><i data-feather="mail" class="feather-sm text-success me-1 ms-1"></i>
                                Inbox</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i>
                                Account Setting</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                            {{-- onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" --}}
                            >
                                <i data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i>
                                {{ __('Logout') }}
                            </a>
                            <div class="dropdown-divider"></div>
                            <div class="pl-4 p-2"><a href="{{ url('/') }}"
                                    class="btn d-block w-100 btn-info rounded-pill">View Profile</a></div>
                        </div>
                    @endguest
                </li>
<!-- 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href=""
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
                            class="flag-icon flag-icon-us"></i></a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"> <a
                            class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a
                            class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a
                            class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a
                            class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a>
                    </div>
                </li> -->
            </ul>
        </div>
    </nav>
</header>