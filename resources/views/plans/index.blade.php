@extends('layouts.index')

@section('title')
    {{ __('Plans') }}
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
                    <h3 class="page-title">Showing All Plans</h3>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">All Plans</li>
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
                            <h4 class="card-title mb-0">Plans</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive users-table">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead class="thead">
                                        <tr>
                                            <th>ID</th>
                                            <th class="hidden-sm hidden-xs hidden-md">Title</th>
                                            <th>Price</th>
                                            <th>Type</th>
                                            {{-- <th class="hidden-sm hidden-xs hidden-md">Description</th> --}}
                                            <th colspan="3" class="no-search no-sort hidden-sm hidden-xs hidden-md">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="users_table">
                                        @foreach($plans as $plan)
                                            <tr>
                                                <td>{{ $plan->id }}</td>
                                                <td>{{ $plan->title }}</td>
                                                <td>{{ $plan->price }}</td>
                                                <td>{{ ucfirst($plan->type) }}</td>
                                                {{-- <td>{!! $plan->description !!}</td> --}}
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{ route('plans.show', [$plan->id]) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.show') !!}">
                                                        {!! __('laravelusers::laravelusers.buttons.show') !!}
                                                    </a> 
                                                    <a class="btn btn-sm btn-info" href="{{ route('plans.edit', [$plan->id]) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.edit') !!}">
                                                        {!! __('laravelusers::laravelusers.buttons.edit') !!}
                                                    </a> 
                                                    {!! Form::open(array('route' => ['plans.destroy', $plan->id], 'class' => '', 'style' => 'display:inline-block;', 'data-bs-toggle' => 'tooltip', 'title' => __('laravelusers::laravelusers.tooltips.delete'))) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(__('laravelusers::laravelusers.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-bs-toggle' => 'modal', 'data-bs-target' => '#al-danger-alert', 'data-bs-id' => $plan->id, 'data-bs-title' => __('Delete Plan'), 'data-bs-message' => __('laravelusers::modals.delete_user_message', ['user' => $plan->title]))) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $plans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="al-danger-alert" tabindex="-1" aria-labelledby="vertical-center-modal" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-light-danger">
                    <div class="modal-body p-4">
                        <div class="text-center text-danger">
                            <i data-feather="x-octagon" class="fill-white feather-lg"></i>
                            <h4 class="mt-2">Oh snap!</h4>
                            <p class="mt-3">Cras mattis consectetur purus sit amet fermentum.Cras justo odio, dapibus ac facilisis in, egestas eget quam.</p>
                            <form action="" method="post" class="userDeleteForm">
                                <input type="hidden" name="_method" value="DELETE" />
                                @csrf
                                <button type="submit" class="btn btn-light my-2">Continue</button>
                                <button type="button" class="btn btn-primary my-2"
                                    data-bs-dismiss="modal">Cancel</button>
                            </form>
                            
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
    <script src="{{ asset('dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
    <script type="text/javascript">
        $('#al-danger-alert').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-bs-message');
            var title = $(e.relatedTarget).attr('data-bs-title');
            var id = $(e.relatedTarget).attr('data-bs-id');
            var form = $(e.relatedTarget).closest('form');
            console.log(id);
            var APP_URL = {!! json_encode(url('plans/')) !!}
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-body h4').text(title);
            $(this).find('.userDeleteForm').attr('action', APP_URL + "/" + id);
        });
    </script>
@endsection