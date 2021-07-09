@extends(config('laravelusers.laravelUsersBladeExtended'))

@section('title')
    {!! __('laravelusers::laravelusers.showing-all-users') !!}
@endsection

@section('css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-wrapper">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-sm-12">
                        @include('laravelusers::partials.form-status')
                    </div>
                    <div class="col-md-5 align-self-center">
                        <h3 class="page-title">Showing All Users</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Users</li>
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
        @endif
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="border-bottom title-part-padding">
                            <h4 class="card-title mb-0">Users</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive users-table">
                                <table id="file_export" class="table table-striped table-bordered display">

                                    <thead class="thead">
                                        <tr>
                                            <th>{!! __('laravelusers::laravelusers.users-table.id') !!}</th>
                                            <th>{!! __('laravelusers::laravelusers.users-table.name') !!}</th>
                                            <th class="hidden-xs">{!! __('laravelusers::laravelusers.users-table.email') !!}</th>
                                            @if(config('laravelusers.rolesEnabled'))
                                                <th class="hidden-sm hidden-xs">{!! __('laravelusers::laravelusers.users-table.role') !!}</th>
                                            @endif
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('laravelusers::laravelusers.users-table.created') !!}</th>
                                            <th class="hidden-sm hidden-xs hidden-md">{!! __('laravelusers::laravelusers.users-table.updated') !!}</th>
                                            <th width="90px;" class="no-search no-sort hidden-sm hidden-xs hidden-md">{!! __('laravelusers::laravelusers.users-table.actions') !!}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="users_table">
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td class="hidden-xs">{{$user->email}}</td>
                                                @if(config('laravelusers.rolesEnabled'))
                                                    <td class="hidden-sm hidden-xs">
                                                        @foreach ($user->roles as $user_role)
                                                            @if ($user_role->name == 'User')
                                                                @php $badgeClass = 'primary' @endphp
                                                            @elseif ($user_role->name == 'Admin')
                                                                @php $badgeClass = 'warning' @endphp
                                                            @elseif ($user_role->name == 'Unverified')
                                                                @php $badgeClass = 'danger' @endphp
                                                            @else
                                                                @php $badgeClass = 'dark' @endphp
                                                            @endif
                                                            <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>
                                                        @endforeach
                                                    </td>
                                                @endif
                                                <td class="hidden-sm hidden-xs hidden-md">{{$user->created_at}}</td>
                                                <td class="hidden-sm hidden-xs hidden-md">{{$user->updated_at}}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{ URL::to('users/' . $user->id) }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.show') !!}">
                                                        {!! __('laravelusers::laravelusers.buttons.show') !!}
                                                    </a> 
                                                    <a class="btn btn-sm btn-info" href="{{ URL::to('users/' . $user->id . '/edit') }}" data-toggle="tooltip" title="{!! __('laravelusers::laravelusers.tooltips.edit') !!}">
                                                        {!! __('laravelusers::laravelusers.buttons.edit') !!}
                                                    </a> 
                                                    {!! Form::open(array('url' => 'users/' . $user->id, 'class' => '', 'style' => 'display:inline-block;', 'data-bs-toggle' => 'tooltip', 'title' => __('laravelusers::laravelusers.tooltips.delete'))) !!}
                                                        {!! Form::hidden('_method', 'DELETE') !!}
                                                        {!! Form::button(__('laravelusers::laravelusers.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-bs-toggle' => 'modal', 'data-bs-target' => '#al-danger-alert', 'data-bs-id' => $user->id, 'data-bs-title' => __('laravelusers::modals.delete_user_title'), 'data-bs-message' => __('laravelusers::modals.delete_user_message', ['user' => $user->name]))) !!}
                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if($pagintaionEnabled)
                                    {{ $users->links() }}
                                @endif
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

        <footer class="footer">
            All right reserved by {{ config('app.name', 'Laravel') }} {{ date('Y') }}
        </footer>
    </div>

    {{-- @include('laravelusers::modals.modal-delete') --}}

@endsection

@section('scripts')
    {{-- @if ((count($users) > config('laravelusers.datatablesJsStartCount')) && config('laravelusers.enabledDatatablesJs'))
        @include('laravelusers::scripts.datatables')
    @endif --}}
    {{-- @include('laravelusers::scripts.delete-modal-script') --}}
    @include('laravelusers::scripts.save-modal-script')
    @if(config('laravelusers.tooltipsEnabled'))
        @include('laravelusers::scripts.tooltips')
    @endif
    @if(config('laravelusers.enableSearchUsers'))
        @include('laravelusers::scripts.search-users')
    @endif

    <script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/datatable/custom-datatable.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>
    <script type="text/javascript">

        $('#al-danger-alert').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-bs-message');
            var title = $(e.relatedTarget).attr('data-bs-title');
            var id = $(e.relatedTarget).attr('data-bs-id');
            var form = $(e.relatedTarget).closest('form');
            console.log(id);
            var APP_URL = {!! json_encode(url('users/')) !!}
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-body h4').text(title);
            $(this).find('.userDeleteForm').attr('action', APP_URL + "/" + id);
            // $(this).find('.modal-footer #confirm').data('form', form);
        });
        // $('#al-danger-alert').find('.modal-footer #confirm').on('click', function(){
        //     $(this).data('form').submit();
        // });
      
    </script>
@endsection