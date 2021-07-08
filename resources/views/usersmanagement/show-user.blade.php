@extends('layouts.index')

@section('title')
  {!! __('usersmanagement.showing-user', ['name' => $user->name]) !!}
@endsection

@php
  $levelAmount = __('usersmanagement.labelUserLevel');
  if ($user->level() >= 2) {
    $levelAmount = __('usersmanagement.labelUserLevels');
  }
@endphp

@section('content')
	<div class="page-wrapper">
		<div class="container container-fluid">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">

					<div class="card">

					<div class="card-header text-white @if ($user->is_active == 1) bg-success @else bg-danger @endif">
						<div style="display: flex; justify-content: space-between; align-items: center;">
						{!! __('usersmanagement.showing-user-title', ['name' => $user->name]) !!}
						<div class="float-right">
							<a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{{ __('usersmanagement.tooltips.back-users') }}">
								{{-- <i data-feather="arrow-left" class="feather feather-arrow-left"></i> --}}
								<i class="fa fa-fw fa-reply" aria-hidden="true"></i>
								{!! __('usersmanagement.buttons.back-to-users') !!}
							</a>
						</div>
						</div>
					</div>

					<div class="card-body">

						<div class="row">
						<div class="col-sm-4 offset-sm-2 col-md-2 offset-md-3">
							<img src="@if ($user->profile) {{ $user->profile->photo_url }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}" class="rounded-circle center-block mb-3 mt-4 user-image">
						</div>
						<div class="col-sm-4 col-md-6">
							<h4 class="text-muted margin-top-sm-1 text-center text-left-tablet">
							{{ $user->name }}
							</h4>
							<p class="text-center text-left-tablet">
							<strong>
								{{ $user->name }} {{ $user->last_name }}
							</strong>
							@if($user->email)
								<br />
								<span class="text-center" data-toggle="tooltip" data-placement="top" title="{{ __('usersmanagement.tooltips.email-user', ['user' => $user->email]) }}">
								{{ Html::mailto($user->email, $user->email) }}
								</span>
							@endif
							</p>
							{{-- @if ($user->profile)
							<div class="text-center text-left-tablet mb-4">
								<a href="{{ url('/profile/'.$user->name) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="left" title="{{ __('usersmanagement.viewProfile') }}">
								<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md"> {{ __('usersmanagement.viewProfile') }}</span>
								</a>
								<a href="/users/{{$user->id}}/edit" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="{{ __('usersmanagement.editUser') }}">
								<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md"> {{ __('usersmanagement.editUser') }} </span>
								</a>
								{!! Form::open(array('url' => 'users/' . $user->id, 'class' => 'form-inline', 'data-toggle' => 'tooltip', 'data-placement' => 'right', 'title' => __('usersmanagement.deleteUser'))) !!}
								{!! Form::hidden('_method', 'DELETE') !!}
								{!! Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">' . __('usersmanagement.deleteUser') . '</span>' , array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user?')) !!}
								{!! Form::close() !!}
							</div>
							@endif --}}
						</div>
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@if ($user->name)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelUserName') }}
							</strong>
						</div>

						<div class="col-sm-7">
							{{ $user->name }}
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif

						@if ($user->email)

						<div class="col-sm-5 col-6 text-larger">
						<strong>
							{{ __('usersmanagement.labelEmail') }}
						</strong>
						</div>

						<div class="col-sm-7">
						<span data-toggle="tooltip" data-placement="top" title="{{ __('usersmanagement.tooltips.email-user', ['user' => $user->email]) }}">
							{{ HTML::mailto($user->email, $user->email) }}
						</span>
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif

						@if ($user->name)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelFirstName') }}
							</strong>
						</div>

						<div class="col-sm-7">
							{{ $user->name }}
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif

						@if ($user->lastname)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelLastName') }}
							</strong>
						</div>

						<div class="col-sm-7">
							{{ $user->lastname }}
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif

						<div class="col-sm-5 col-6 text-larger">
						<strong>
							{{ __('usersmanagement.labelRole') }}
						</strong>
						</div>

						<div class="col-sm-7">
						@foreach ($user->roles as $user_role)

							@if ($user_role->name == 'User')
							@php $badgeClass = 'primary' @endphp

							@elseif ($user_role->name == 'Admin')
							@php $badgeClass = 'warning' @endphp

							@elseif ($user_role->name == 'Unverified')
							@php $badgeClass = 'danger' @endphp

							@else
							@php $badgeClass = 'default' @endphp

							@endif

							<span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>

						@endforeach
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						<div class="col-sm-5 col-6 text-larger">
						<strong>
							{{ __('usersmanagement.labelStatus') }}
						</strong>
						</div>

						<div class="col-sm-7">
						@if ($user->is_active == 1)
							<span class="badge badge-success">
							Activated
							</span>
						@else
							<span class="badge badge-danger">
							Not-Activated
							</span>
						@endif
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						<div class="col-sm-5 col-6 text-larger">
						<strong>
							{{ __('usersmanagement.labelAccessLevel')}} {{ $levelAmount }}:
						</strong>
						</div>

						<div class="col-sm-7">

						@if($user->level() >= 5)
							<span class="badge badge-primary margin-half margin-left-0">5</span>
						@endif

						@if($user->level() >= 4)
							<span class="badge badge-info margin-half margin-left-0">4</span>
						@endif

						@if($user->level() >= 3)
							<span class="badge badge-success margin-half margin-left-0">3</span>
						@endif

						@if($user->level() >= 2)
							<span class="badge badge-warning margin-half margin-left-0">2</span>
						@endif

						@if($user->level() >= 1)
							<span class="badge badge-default margin-half margin-left-0">1</span>
						@endif

						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						<div class="col-sm-5 col-6 text-larger">
						<strong>
							{{ __('usersmanagement.labelPermissions') }}
						</strong>
						</div>

						<div class="col-sm-7">
						@if($user->canViewUsers())
							<span class="badge badge-primary margin-half margin-left-0">
							{{ __('permsandroles.permissionView') }}
							</span>
						@endif

						@if($user->canCreateUsers())
							<span class="badge badge-info margin-half margin-left-0">
							{{ __('permsandroles.permissionCreate') }}
							</span>
						@endif

						@if($user->canEditUsers())
							<span class="badge badge-warning margin-half margin-left-0">
							{{ __('permsandroles.permissionEdit') }}
							</span>
						@endif

						@if($user->canDeleteUsers())
							<span class="badge badge-danger margin-half margin-left-0">
							{{ __('permsandroles.permissionDelete') }}
							</span>
						@endif
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@if ($user->created_at)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelCreatedAt') }}
							</strong>
						</div>

						<div class="col-sm-7">
							{{ $user->created_at }}
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif

						@if ($user->updated_at)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelUpdatedAt') }}
							</strong>
						</div>

						<div class="col-sm-7">
							{{ $user->updated_at }}
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif

						{{-- @if ($user->signup_ip_address)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelIpEmail') }}
							</strong>
						</div>

						<div class="col-sm-7">
							<code>
							{{ $user->signup_ip_address }}
							</code>
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif --}}

						{{-- @if ($user->signup_confirmation_ip_address)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelIpConfirm') }}
							</strong>
						</div>

						<div class="col-sm-7">
							<code>
							{{ $user->signup_confirmation_ip_address }}
							</code>
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif --}}

						{{-- @if ($user->signup_sm_ip_address)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelIpSocial') }}
							</strong>
						</div>

						<div class="col-sm-7">
							<code>
							{{ $user->signup_sm_ip_address }}
							</code>
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif --}}

						{{-- @if ($user->admin_ip_address)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelIpAdmin') }}
							</strong>
						</div>

						<div class="col-sm-7">
							<code>
							{{ $user->admin_ip_address }}
							</code>
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif --}}

						{{-- @if ($user->updated_ip_address)

						<div class="col-sm-5 col-6 text-larger">
							<strong>
							{{ __('usersmanagement.labelIpUpdate') }}
							</strong>
						</div>

						<div class="col-sm-7">
							<code>
							{{ $user->updated_ip_address }}
							</code>
						</div>

						<div class="clearfix"></div>
						<div class="border-bottom"></div>

						@endif --}}

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
		</div>
		<footer class="footer">
			All right reserved by {{ config('app.name', 'Laravel') }} {{ date('Y') }}
		</footer>
	</div>
@endsection
@section('scripts')
	@if(config('usersmanagement.tooltipsEnabled'))
		@include('scripts.tooltips')
	@endif
@endsection
