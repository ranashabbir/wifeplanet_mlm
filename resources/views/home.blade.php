@extends('layouts.index')
@section('title')
    {{ __('Dashboard') }}
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/dist/apexcharts.css') }}">
    <link href="{{ asset('assets/extra-libs/css-chart/css-chart.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-md-5 align-self-center">
                <h3 class="page-title">{{ __('Dashboard') }}</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">{{ __('Dashboard') }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Row -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <h4 class="card-title">Total Revenue</h4>
                            <div class="ms-auto">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <h6 class="text-muted"><i class="fa fa-circle me-1 text-success"></i>2016</h6>
                                    </li>
                                    <li class="list-inline-item">
                                        <h6 class="text-muted"><i class="fa fa-circle me-1 text-info"></i>2020</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="total-revenue"></div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-6">
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card card-body">
                            <!-- Row -->
                            <div class="row pt-2 pb-2">
                                <!-- Column -->
                                <div class="col pr-0">
                                    <h1 class="fw-light">86</h1>
                                    <h6 class="text-muted">New Clients</h6></div>
                                <!-- Column -->
                                <div class="col text-end align-self-center">
                                    <div data-label="20%" class="css-bar mb-0 css-bar-primary css-bar-20"><i class="mdi mdi-account-circle"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card card-body">
                            <!-- Row -->
                            <div class="row pt-2 pb-2">
                                <!-- Column -->
                                <div class="col pr-0">
                                    <h1 class="fw-light">248</h1>
                                    <h6 class="text-muted">All Projects</h6></div>
                                <!-- Column -->
                                <div class="col text-end align-self-center">
                                    <div data-label="30%" class="css-bar mb-0 css-bar-danger css-bar-20"><i class="mdi mdi-briefcase-check"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card card-body">
                            <!-- Row -->
                            <div class="row pt-2 pb-2">
                                <!-- Column -->
                                <div class="col pr-0">
                                    <h1 class="fw-light">352</h1>
                                    <h6 class="text-muted">New Items</h6></div>
                                <!-- Column -->
                                <div class="col text-end align-self-center">
                                    <div data-label="40%" class="css-bar mb-0 css-bar-warning css-bar-40"><i class="mdi mdi-star-circle"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-sm-6">
                        <div class="card card-body">
                            <!-- Row -->
                            <div class="row pt-2 pb-2">
                                <!-- Column -->
                                <div class="col pr-0">
                                    <h1 class="fw-light">159</h1>
                                    <h6 class="text-muted">Invoices</h6></div>
                                <!-- Column -->
                                <div class="col text-end align-self-center">
                                    <div data-label="60%" class="css-bar mb-0 css-bar-info css-bar-60"><i class="mdi mdi-receipt"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center no-block">
                            <h4 class="card-title">Sales of the Month</h4>
                            <div class="ms-auto">
                                <select class="form-select">
                                    <option selected>January</option>
                                    <option value="1">February</option>
                                    <option value="2">March</option>
                                    <option value="3">April</option>
                                </select>
                            </div>
                        </div>
                        <!-- Row -->
                        <div class="row mt-4">
                            <div class="col-md-7">
                                <div id="sales-of-the-month" class="m-auto"></div>
                                <!-- <div class="round-overlap sales"><i class="mdi mdi-cart"></i></div> -->
                            </div>
                            <div class="col-md-5 align-self-center">
                                <h1 class="mb-0">65<small>%</small></h1>
                                <h6 class="text-muted">160 Sales January</h6>
                                <ul class="list-icons mt-4 list-style-none">
                                    <li class="my-1 py-1"><i class="fa fa-circle text-purple ps-2"></i> Organic Sales</li>
                                    <li class="my-1 py-1"><i class="fa fa-circle text-success ps-2"></i> Search Engine</li>
                                    <li class="my-1 py-1"><i class="fa fa-circle text-info ps-2"></i> Marketing</li>
                                </ul>
                            </div>
                        </div>
                        <!-- Row -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <h4 class="card-title">Income of the Year</h4>
                            <div class="ms-auto">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <h6 class="text-muted"><i class="fa fa-circle me-1 text-success"></i>Net</h6>
                                    </li>
                                    <li class="list-inline-item">
                                        <h6 class="text-muted"><i class="fa fa-circle me-1 text-info"></i>Growth</h6>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="income-of-the-year"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center no-block">
                            <h4 class="card-title">Projects of the Month</h4>
                            <div class="ms-auto">
                                <select class="form-select">
                                    <option selected>January</option>
                                    <option value="1">February</option>
                                    <option value="2">March</option>
                                    <option value="3">April</option>
                                </select>
                            </div>
                        </div>
                        <div class="table-responsive mt-2">
                            <table class="table stylish-table mb-0 no-wrap v-middle">
                                <thead>
                                    <tr>
                                        <th class="fw-normal text-muted border-0 border-bottom" colspan="2">Assigned</th>
                                        <th class="fw-normal text-muted border-0 border-bottom">Name</th>
                                        <th class="fw-normal text-muted border-0 border-bottom">Priority</th>
                                        <th class="fw-normal text-muted border-0 border-bottom">Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="width:50px;"><span class="round rounded-circle text-white d-inline-block text-center bg-info">S</span></td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0 nowrap">Sunil Joshi</h6><small class="text-muted no-wrap">Web Designer</small></td>
                                        <td>Elite Admin</td>
                                        <td><span class="badge bg-light-success text-success">Low</span></td>
                                        <td>$3.9K</td>
                                    </tr>
                                    <tr class="active">
                                        <td><span class="round text-white d-inline-block text-center"><img src="../assets/images/users/2.jpg" alt="user" class="rounded-circle" width="50" /></span></td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0 nowrap">Andrew</h6><small class="text-muted no-wrap">Project Manager</small></td>
                                        <td>Real Homes</td>
                                        <td><span class="badge bg-light-info text-info">Medium</span></td>
                                        <td>$23.9K</td>
                                    </tr>
                                    <tr>
                                        <td><span class="round rounded-circle text-white d-inline-block text-center bg-success">B</span></td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0 nowrap">Bhavesh patel</h6><small class="text-muted no-wrap">Developer</small></td>
                                        <td>MedicalPro Theme</td>
                                        <td><span class="badge bg-light-danger text-danger">High</span></td>
                                        <td>$12.9K</td>
                                    </tr>
                                    <tr>
                                        <td><span class="round rounded-circle text-white d-inline-block text-center bg-primary">N</span></td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0 nowrap">Nirav Joshi</h6><small class="text-muted no-wrap">Frontend Eng</small></td>
                                        <td>Elite Admin</td>
                                        <td><span class="badge bg-light-success text-success">Low</span></td>
                                        <td>$10.9K</td>
                                    </tr>
                                    <tr>
                                        <td><span class="round rounded-circle text-white d-inline-block text-center bg-warning">M</span></td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0 nowrap">Micheal Doe</h6><small class="text-muted no-wrap">Content Writer</small></td>
                                        <td>Helping Hands</td>
                                        <td><span class="badge bg-light-danger text-danger">High</span></td>
                                        <td>$12.9K</td>
                                    </tr>
                                    <tr>
                                        <td><span class="round rounded-circle text-white d-inline-block text-center bg-danger">N</span></td>
                                        <td>
                                            <h6 class="font-weight-medium mb-0 nowrap">Johnathan</h6><small class="text-muted no-wrap">Graphic</small></td>
                                        <td>Digital Agency</td>
                                        <td><span class="badge bg-light-danger text-danger">High</span></td>
                                        <td>$2.6K</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-md-flex align-items-center">
                            <h4 class="card-title">Weather Report</h4>
                            <div class="ms-auto">
                                <select class="form-select">
                                    <option selected>Today</option>
                                    <option value="1">Weekly</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex align-items-center flex-row mt-4">
                            <div class="p-2 display-5 text-info"><i class="wi wi-day-showers"></i> <span>73<sup>°</sup></span></div>
                            <div class="p-2">
                                <h3 class="mb-0">Saturday</h3><small>Ahmedabad, India</small></div>
                        </div>
                        <table class="table table-borderless">
                            <tr>
                                <td>Wind</td>
                                <td class="fw-normal">ESE 17 mph</td>
                            </tr>
                            <tr>
                                <td>Humidity</td>
                                <td class="fw-normal">83%</td>
                            </tr>
                            <tr>
                                <td>Pressure</td>
                                <td class="fw-normal">28.56 in</td>
                            </tr>
                            <tr>
                                <td>Cloud Cover</td>
                                <td class="fw-normal">78%</td>
                            </tr>
                            <tr>
                                <td>Ceiling</td>
                                <td class="fw-normal">25760 ft</td>
                            </tr>
                        </table>
                        <ul class="list-unstyled row text-center city-weather-days border-top m-0 pt-3">
                            <li class="col col-6 col-md-3 text-center pt-1"><i class="d-block fs-6 text-info wi wi-day-sunny"></i><span class="d-block tetxt-muted text-nowrap pt-2">09:30</span>
                                </li>
                            <li class="col col-6 col-md-3 text-center pt-1"><i class="d-block fs-6 text-info wi wi-day-cloudy"></i><span class="d-block tetxt-muted text-nowrap pt-2">11:30</span></li>
                            <li class="col col-6 col-md-3 text-center pt-1"><i class="d-block fs-6 text-info wi wi-day-hail"></i><span class="d-block tetxt-muted text-nowrap pt-2">13:30</span></li>
                            <li class="col col-6 col-md-3 text-center pt-1"><i class="d-block fs-6 text-info wi wi-day-sprinkle"></i><span class="d-block tetxt-muted text-nowrap pt-2">15:30</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recent Comments</h4>
                    </div>
                    <!-- ============================================================== -->
                    <!-- Comment widgets -->
                    <!-- ============================================================== -->
                    <div class="comment-widgets scrollable position-relative mb-2" style="height: 450px;">
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row p-2 p-md-3">
                            <div class="p-1 p-md-2"><span class="round text-white d-inline-block text-center"><img src="../assets/images/users/1.jpg" alt="user" width="50" class="rounded-circle"></span></div>
                            <div class="comment-text w-100 py-1 py-md-3 pr-md-3 pl-md-4 px-2">
                                <h5 class="font-weight-medium">James Anderson</h5>
                                <p class="mb-1 fs-3 fw-light text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
                                <div class="comment-footer d-md-flex align-items-center mt-2">                                            
                                    <span class="badge bg-light-info text-info">Pending</span>
                                    <span class="action-icons">
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-check"></i></a>
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-heart"></i></a>    
                                        </span>
                                    <span class="text-muted ms-auto d-block text-end fs-2 fw-normal">April 14, 2016</span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row p-2 p-md-3 active">
                            <div class="p-1 p-md-2"><span class="round text-white d-inline-block text-center"><img src="../assets/images/users/2.jpg" alt="user" width="50" class="rounded-circle"></span></div>
                            <div class="comment-text active w-100 py-1 py-md-3 pr-md-3 pl-md-4 px-2">
                                <h5 class="font-weight-medium">Michael Jorden</h5>
                                <p class="mb-1 fs-3 fw-light text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry..</p>
                                <div class="comment-footer d-md-flex align-items-center  mt-2">
                                    <span class="badge bg-light-success text-success">Approved</span>
                                    <span class="action-icons active">
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="icon-close"></i></a>
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-heart text-danger"></i></a>    
                                        </span>
                                    <span class="text-muted ms-auto  d-block text-end fs-2 fw-normal">April 14, 2016</span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row p-2 p-md-3">
                            <div class="p-1 p-md-2"><span class="round text-white d-inline-block text-center"><img src="../assets/images/users/3.jpg" alt="user" width="50" class="rounded-circle"></span></div>
                            <div class="comment-text w-100 py-1 py-md-3 pr-md-3 pl-md-4 px-2">
                                <h5 class="font-weight-medium">Johnathan Doeting</h5>
                                <p class="mb-1 fs-3 fw-light text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry.</p>
                                <div class="comment-footer d-md-flex align-items-center mt-2">
                                    <span class="badge bg-light-danger text-danger">Rejected</span>
                                    <span class="action-icons">
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-pencil-alt"></i></a>
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-check"></i></a>
                                            <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-heart"></i></a>    
                                        </span>
                                    <span class="text-muted ms-auto d-block text-end fs-2 fw-normal">April 14, 2016</span>
                                </div>
                            </div>
                        </div>
                        <!-- Comment Row -->
                        <div class="d-flex flex-row comment-row p-2 p-md-3">
                            <div class="p-1 p-md-2"><span class="round text-white d-inline-block text-center"><img src="../assets/images/users/4.jpg" alt="user" width="50" class="rounded-circle"></span></div>
                            <div class="comment-text w-100 py-1 py-md-3 pr-md-3 pl-md-4 px-2">
                                <h5 class="font-weight-medium">James Anderson</h5>
                                <p class="mb-1 fs-3 fw-light text-muted">Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has beenorem Ipsum is simply dummy text of the printing and type setting industry..</p>
                                <div class="comment-footer d-md-flex align-items-center mt-2">
                                    <span class="badge bg-light-info text-info">Pending</span>
                                    <span class="action-icons">
                                                <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-pencil-alt"></i></a>
                                                <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-check"></i></a>
                                                <a href="javascript:void(0)" class="ps-2 align-middle"><i class="ti-heart"></i></a>    
                                            </span>
                                    <span class="text-muted ms-auto d-block text-end fs-2 fw-normal">April 14, 2016</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">To Do list</h4>
                            <div class="ms-auto">
                                <button class="btn btn-sm btn-rounded btn-success" data-bs-toggle="modal" data-bs-target="#myModal">Add Task</button>
                            </div>
                        </div>
                        <!-- .modal for add task -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex align-items-center">
                                            <h4 class="modal-title">Add Task</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="mb-3">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" placeholder="Enter Your Name">
                                                </div>
                                                <div class="mb-3">
                                                    <label>Email address</label>
                                                    <input type="email" class="form-control" placeholder="Enter email">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Submit</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        <!-- ============================================================== -->
                        <!-- To do list widgets -->
                        <!-- ============================================================== -->
                        <div class="to-do-widget mt-3 scrollable"  style="height: 444px;">
                            
                            <ul class="list-task todo-list list-group mb-0" data-role="tasklist">
                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                                    <div class="form-check border-start border-2 border-info ps-1">
                                        <input type="checkbox" class="form-check-input ms-2" id="inputSchedule" name="inputCheckboxesSchedule">
                                        <label for="inputSchedule" class="form-check-label ps-2 fw-normal"> <span>Schedule meeting with</span> </label>
                                    </div>
                                    <ul class="assignedto list-inline m-0 ps-4 ms-3 mt-2">
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/1.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Steave"></li>
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/2.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Jessica"></li>
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Priyanka"></li>
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                                    <div class="form-check border-start border-2 border-danger ps-1 d-flex">
                                        <input type="checkbox" class="form-check-input ms-2" id="inputCall" name="inputCheckboxesCall">
                                        <label for="inputCall" class="form-check-label ps-2 fw-normal"> <span>Give Purchase report to</span> <span class="badge bg-light-danger text-danger">Today</span> </label>
                                    </div>
                                    <ul class="assignedto list-inline m-0 ps-4 ms-3 mt-2">
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/3.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Priyanka"></li>
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Selina"></li>
                                    </ul>
                                </li>
                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                                    <div class="form-check border-start border-2 border-primary ps-1">
                                        <input type="checkbox" class="form-check-input ms-2" id="inputBook" name="inputCheckboxesBook">
                                        <label for="inputBook" class="form-check-label ps-2 fw-normal"> <span>Book flight for holiday</span> </label>
                                    </div>
                                    <div class="item-date fs-2 ps-4 ms-3 text-muted d-inline-block"> 26 jun 2021</div>
                                </li>
                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                                    <div class="form-check border-start border-2 border-warning ps-1">
                                        <input type="checkbox" class="form-check-input ms-2" id="inputForward" name="inputCheckboxesForward">
                                        <label for="inputForward" class="form-check-label ps-2 fw-normal"> <span>Forward all tasks</span> <span class="badge bg-light-warning text-warning">2 weeks</span> </label>
                                    </div>
                                    <div class="item-date fs-2 ps-4 ms-3 text-muted d-inline-block"> 26 jun 2021</div>
                                </li>
                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                                    <div class="form-check border-start border-2 border-primary ps-1">
                                        <input type="checkbox" class="form-check-input ms-2" id="inputRecieve" name="inputCheckboxesRecieve">
                                        <label for="inputRecieve" class="form-check-label ps-2 fw-normal"> <span>Recieve shipment</span> </label>
                                    </div>
                                    <div class="item-date fs-2 ps-4 ms-3 text-muted d-inline-block"> 26 jun 2021</div>
                                </li>
                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                                    <div class="form-check border-start border-2 border-info ps-1">
                                        <input type="checkbox" class="form-check-input ms-2" id="inputpayment" name="inputCheckboxespayment">
                                        <label for="inputpayment" class="form-check-label ps-2 fw-normal"> <span>Send payment today</span> </label>
                                    </div>
                                    <div class="item-date fs-2 ps-4 ms-3 text-muted d-inline-block"> 26 jun 2021</div>
                                </li>
                                <li class="list-group-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                                    <div class="form-check border-start border-2 border-success ps-1">
                                        <input type="checkbox" class="form-check-input ms-2" id="inputForward2" name="inputCheckboxesd">
                                        <label for="inputForward2" class="form-check-label ps-2 fw-normal"> <span>Important tasks</span> <span class="badge bg-light-success text-success">2 weeks</span> </label>
                                    </div>
                                    <ul class="assignedto list-inline m-0 ps-4 ms-3 mt-2">
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/1.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Assign to Steave"></li>
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/2.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Assign to Jessica"></li>
                                        <li class="list-inline-item"><img class="rounded-circle" src="../assets/images/users/4.jpg" alt="user" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="Assign to Selina"></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
    </div>

    <footer class="footer"> All right reserved by {{ config('app.name', 'Laravel') }} {{ date('Y') }} </footer>
</div>
@endsection

@push('script')
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard5.js') }}"></script>
@endpush