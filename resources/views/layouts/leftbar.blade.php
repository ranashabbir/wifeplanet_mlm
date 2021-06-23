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
                        <div class="profile-img m-auto"> <img src="{{ asset('assets/images/users/5.jpg') }}" alt="user" class="w-100 rounded-circle" /> </div>
                        <!-- User profile text-->
                        <div class="profile-text py-1"> 
                            <a href="#" class="dropdown-toggle link u-dropdown" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">{{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="#">
                                    <i data-feather="user" class="feather-sm text-info me-1 ms-1"></i> My Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i data-feather="credit-card" class="feather-sm text-info me-1 ms-1"></i> My Balance
                                </a>
                                <a class="dropdown-item" href="#">
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
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span class="hide-menu">User Management </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ route('users') }}" class="sidebar-link {{ request()->is('users') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                        <li class="sidebar-item"><a href="{{ route('users.create') }}" class="sidebar-link {{ request()->is('users/create') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Create New </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('users/deleted') }}" class="sidebar-link {{ request()->is('users/deleted') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Deleted Users </span></a></li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i data-feather="sidebar" class="feather-icon"></i><span class="hide-menu">Role Management </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('/roles') }}" class="sidebar-link {{ request()->is('roles') ? 'active' : '' }}"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> View All </span></a></li>
                        <li class="sidebar-item"><a href="{{ url('/roles/create') }}" class="sidebar-link {{ request()->is('roles/create') ? 'active' : '' }}"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Create New </span></a></li>
                    </ul>
                </li>
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