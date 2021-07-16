@extends('layouts.index')

@section('title')
    {{ __('All Countries') }}
@endsection

@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="animated fadeIn">
                @include('flash::message')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <i class="fa fa-align-justify"></i>
                                Countries
                                <a class="pull-right" href="{{ route('countries.create') }}"><i class="fa fa-plus-square fa-lg"></i></a>
                            </div>
                            <div class="card-body">
                                @include('countries.table')
                                <div class="pull-right mr-3">
                                        
                                </div>
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
            var APP_URL = {!! json_encode(url('countries/')) !!}
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-body h4').text(title);
            $(this).find('.userDeleteForm').attr('action', APP_URL + "/" + id);
        });
    </script>
@endsection