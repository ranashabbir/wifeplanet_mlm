@extends('layouts.index')

@section('title')
    {{ __('My Invites') }}
@endsection

@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-sm-12">
                    @include('laravelusers::partials.form-status')
                </div>
                <div class="col-md-5 align-self-center">
                    <h3 class="page-title">Showing All Invites</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Invites</li>
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
            @include('flash::message')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="border-bottom title-part-padding">
                            <h4 class="card-title mb-0">Invites</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive users-table">
                                <table class="table table-striped table-bordered datatable-select-inputs text-nowrap">
                                    <thead class="thead">
                                        <tr>
                                            <th>ID</th>
                                            <th class="hidden-sm hidden-xs hidden-md">Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Parent</th>
                                        </tr>
                                    </thead>
                                    <tbody id="users_table">
                                        @foreach($user->children as $first)
                                            @foreach ($first->children as $second)
                                                @foreach ($second->children as $third)
                                                    @foreach ($third->children as $forth)
                                                        <tr>
                                                            <td>{{ $forth->id }}</td>
                                                            <td>{{ $forth->name }} {{ $forth->lastname }}</td>
                                                            <td>{{ $forth->email }}</td>
                                                            <td>{{ $forth->phone }}</td>
                                                            <td>{{ $forth->parent->name }} {{ $forth->parent->lastname }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td>{{ $third->id }}</td>
                                                        <td>{{ $third->name }} {{ $third->lastname }}</td>
                                                        <td>{{ $third->email }}</td>
                                                        <td>{{ $third->phone }}</td>
                                                        <td>{{ $third->parent->name }} {{ $third->parent->lastname }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>{{ $second->id }}</td>
                                                    <td>{{ $second->name }} {{ $second->lastname }}</td>
                                                    <td>{{ $second->email }}</td>
                                                    <td>{{ $second->phone }}</td>
                                                    <td>{{ $second->parent->name }} {{ $second->parent->lastname }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td>{{ $first->id }}</td>
                                                <td>{{ $first->name }} {{ $first->lastname }}</td>
                                                <td>{{ $first->email }}</td>
                                                <td>{{ $first->phone }}</td>
                                                <td>{{ $first->parent->name }} {{ $first->parent->lastname }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Parent</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/custom-datatable.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/datatable-api.init.js') }}"></script>
@endsection