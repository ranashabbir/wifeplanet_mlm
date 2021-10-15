<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <li>
                    <!-- User profile -->
                    <div class="user-profile text-center position-relative pt-4 mt-1">
                        <!-- User profile image -->
                        <!-- <div class="profile-img m-auto"> <img src="@if(Auth::user()->profile && Auth::user()->profile->avatar) {{ Auth::user()->profile->avatar }} @else {{ asset('assets/images/users/5.jpg') }} @endif" alt="user" class="w-100 rounded-circle" /> </div> -->
                        <!-- User profile text-->
                        <div class="profile-text py-1"> 
                            <a href="#" class="dropdown-toggle link u-dropdown" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="{{ route('profile.show', [Auth::user()->id]) }}">
                                    <i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i data-feather="credit-card" class="feather-sm text-info me-1 ms-1"></i> My Balance
                                </a>
                                <a class="dropdown-item" href="{{ url('/messages/inbox') }}">
                                    <i data-feather="mail" class="feather-sm text-success me-1 ms-1"></i>
                                    Inbox
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i data-feather="settings" class="feather-sm text-warning me-1 ms-1"></i>
                                    Account Setting
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out" class="feather-sm text-danger me-1 ms-1"></i> 
                                    {{ __('Logout') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <div class="ps-4 p-2">
                                    <button type="button" class="btn d-block w-100 btn-info rounded-pill">View Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End User profile text-->
                </li>
                <!-- User Profile-->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('home') ? 'active' : '' }} waves-effect waves-dark" href="{{ route('home') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                {{-- <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">User Management</span></li> --}}
                @if(Auth::user()->hasRole('admin'))
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span class="hide-menu">User Management </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ route('users') }}" class="sidebar-link {{ request()->is('users') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('users/create') }}" class="sidebar-link {{ request()->is('users/create') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Create New </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('reports') }}" class="sidebar-link {{ request()->is('reports') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Reported Users </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span class="hide-menu">Role Management </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ url('/roles') }}" class="sidebar-link {{ request()->is('roles') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('/roles/create') }}" class="sidebar-link {{ request()->is('roles/create') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Create New </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="navigation" class="feather-icon"></i><span class="hide-menu">Countries </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ url('/countries') }}" class="sidebar-link {{ request()->is('countries') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('/countries/create') }}" class="sidebar-link {{ request()->is('countries/create') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Add New </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="navigation-2" class="feather-icon"></i><span class="hide-menu">States </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ url('/states') }}" class="sidebar-link {{ request()->is('states') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('/states/create') }}" class="sidebar-link {{ request()->is('states/create') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Add New </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="map-pin" class="feather-icon"></i><span class="hide-menu">Cities </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ url('/cities') }}" class="sidebar-link {{ request()->is('cities') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('/cities/create') }}" class="sidebar-link {{ request()->is('cities/create') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Add New </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="package" class="feather-icon"></i><span class="hide-menu">Plans Management </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ url('/plans') }}" class="sidebar-link {{ request()->is('plans') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('/plans/create') }}" class="sidebar-link {{ request()->is('plans/create') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Create New </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('/bonuses') }}" class="sidebar-link {{ request()->is('bonuses') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Bonuses </span></a></li>
                        </ul>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('profile*') ? 'active' : '' }} waves-effect waves-dark" href="{{ route('profile.show', [Auth::user()->id]) }}" aria-expanded="false">
                        <i data-feather="user" class="feather"></i>
                        <span class="hide-menu">My Profile</span>
                    </a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span class="hide-menu">Titles </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/titles') }}" class="sidebar-link {{ request()->is('titles') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/mytitles') }}" class="sidebar-link {{ request()->is('mytitles') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> My Titles </span></a></li>
                    </ul>
                </li>
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('mynetworks*') ? 'active' : '' }} waves-effect waves-dark" href="{{ url('mynetworks') }}" aria-expanded="false">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">My Networks</span>
                    </a>
                </li> --}}
                 {{-- @if(Auth::user()->hasRole('admin')) --}}
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="inbox" class="feather-icon"></i><span class="hide-menu">Messages </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('conversations') }}" class="sidebar-link {{ request()->is('conversations*') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Conversation </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/messages/inbox') }}" class="sidebar-link {{ request()->is('messages') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Inbox </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/messages/outbox') }}" class="sidebar-link {{ request()->is('messages/outbox') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Outbox </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/messages/compose') }}" class="sidebar-link {{ request()->is('messages/compose') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Compose </span></a></li>
                    </ul>
                </li>
                {{-- @endif --}}
                {{-- <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('conversations*') ? 'active' : '' }} waves-effect waves-dark" href="{{ url('conversations') }}" aria-expanded="false">
                        <i data-feather="message-circle" class="feather feather-message-circle"></i>
                        <span class="hide-menu">Conversation</span>
                    </a>
                </li> --}}
                @if(!Auth::user()->hasRole('admin'))
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('packages*') ? 'active' : '' }} waves-effect waves-dark" href="{{ url('packages') }}" aria-expanded="false">
                            <i data-feather="package" class="feather feather-package"></i>
                            <span class="hide-menu">Packages</span>
                        </a>
                    </li>
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bank" style="margin: -5px 8px 0 5px;width:18px;height:18px;"></i><span class="hide-menu">My Bank </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ url('/transactions') }}" class="sidebar-link {{ request()->is('transactions') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> All Transactions </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('/withdraw') }}" class="sidebar-link {{ request()->is('withdraw') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Withdraw </span></a></li>
                            <li class="sidebar-item"><a href="{{ url('/deposit') }}" class="sidebar-link {{ request()->is('deposit') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Deposit </span></a></li>
                        </ul>
                    </li>
                @endif
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="user-plus" class="feather-icon"></i><span class="hide-menu">Networks </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/mynetworks') }}" class="sidebar-link {{ request()->is('mynetworks') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> My Networks </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/myinvites') }}" class="sidebar-link {{ request()->is('myinvites') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Invited Members </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/invite') }}" class="sidebar-link {{ request()->is('invite') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Invite New Members </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/registeruser') }}" class="sidebar-link {{ request()->is('registeruser') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Register New Members </span></a></li>
                    </ul>
                </li>
                @if(Auth::user()->hasRole('admin'))
                    <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-bank" style="margin: -5px 8px 0 5px;width:18px;height:18px;"></i><span class="hide-menu">My Bank </span></a>
                        <ul aria-expanded="false" class="collapse  first-level">
                            <li class="sidebar-item"><a href="{{ url('/withdrawal') }}" class="sidebar-link {{ request()->is('withdrawal') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Withdrawal Requests </span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('statistics*') ? 'active' : '' }} {{ request()->is('statistics*') ? 'active' : '' }} waves-effect waves-dark" href="{{ url('statistics') }}" aria-expanded="false">
                            <i data-feather="grid" class="feather feather-package"></i>
                            <span class="hide-menu">MLM Statistics</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('subscriptions*') ? 'active' : '' }} {{ request()->is('commissions*') ? 'active' : '' }} waves-effect waves-dark" href="{{ url('subscriptions') }}" aria-expanded="false">
                            <i data-feather="package" class="feather feather-package"></i>
                            <span class="hide-menu">Subscriptions</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('settings*') ? 'active' : '' }} waves-effect waves-dark" href="{{ route('settings.index') }}" aria-expanded="false">
                            <i data-feather="settings" class="feather feather-settings"></i>
                            <span class="hide-menu">Settings</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('meetings*') ? 'active' : '' }} waves-effect waves-dark" href="{{ route('meetings.index') }}" aria-expanded="false">
                            <i data-feather="menu" class="feather feather-menu"></i>
                            <span class="hide-menu">Meetings</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <!-- Bottom points-->
<!--
    <div class="sidebar-footer">
        <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Settings"><i class="ti-settings"></i></a>
        <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Email"><i class="mdi mdi-gmail"></i></a>
        <a href="#" class="link" data-bs-toggle="tooltip" data-bs-placement="top" title="Logout"><i class="mdi mdi-power"></i></a>
    </div>
-->
    <!-- End Bottom points-->
</aside>