@extends('layouts.index')

@section('title')
	{{ $user->name }}'s Profile
@endsection

@section('template_fastload_css')

	#map-canvas{
		min-height: 300px;
		height: 100%;
		width: 100%;
	}

@endsection

@section('content')
<div class="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
				<div class="card">
					<div class="card-header">

						{{ $user->name }}'s {{ __('Profile') }}

					</div>
					<div class="card-body">
						<h4>Profile Photo</h4>
    					<img src="@if ($user->profile && $user->profile->avatar) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}" class="user-avatar">
						
						<h4>Verification Photo</h4>
						<img class="user-avatar" src="@if($user->profile->verify_photo != NULL){{ Storage::url($user->profile->verify_photo) }}@endif" alt="{{ $user->name }}">
						<dl class="user-info">

							<dt>
								{{ __('Title') }}
							</dt>
							<dd>
								@if (count($usertitle)>0)
									{{ $usertitle[0]->title->name }}
								@else
									{{ __('No Title') }}
								@endif
							</dd>
							
							<dt>
								{{ __('Profile First Name') }}
							</dt>
							<dd>
								{{ $user->name }}
							</dd>

							@if ($user->lastname)
								<dt>
									{{ __('Profile Last Name') }}
								</dt>
								<dd>
									{{ $user->lastname }}
								</dd>
							@endif

							<dt>
								{{ __('Profile Email') }}
							</dt>
							<dd>
								{{ $user->email }}
							</dd>

							<dt>
								{{ __('Crypto Address') }}
							</dt>
							<dd>
								{{ $user->crypto }}
							</dd>

							<dt>
								{{ __('Parent Account') }}
							</dt>
							<dd>
								@if($user->parent) {{ $user->parent->name }} {{ $user->parent->lastname }}@endif
							</dd>
							<dt>
								{{ __('Subscription Plan') }}
							</dt>
							<dd>
								{{ $plan_name }}
							</dd>

							@if ($user->profile)

								@if ($user->profile->location)
									<dt>
										{{ __('Profile Location') }}
									</dt>
									<dd>
										{{ $user->profile->location }} <br />

										@if(config('settings.googleMapsAPIStatus'))
											Latitude: <span id="latitude"></span> / Longitude: <span id="longitude"></span> <br />

											<div id="map-canvas"></div>
										@endif
									</dd>
								@endif
							@endif
						</dl>

						@if (Auth::user()->id == $user->id || Auth::user()->hasRole('admin'))
							<a href="{{ route('profile.edit', [$user->id]) }}" class="btn btn-sm btn-primary" title="{{ __('Edit') }}"><i data-feather="edit" class="feather-icon"></i></a>
						@endif
						@if (Auth::user()->id != $user->id)
							{!! Form::open(array('route' => ['report.user', $user->id], 'class' => '', 'style' => 'display:inline-block;', 'data-bs-toggle' => 'tooltip', 'title' => __('Report User'))) !!}
								{!! Form::hidden('_method', 'POST') !!}
								{!! Form::button('<i data-feather="user-minus" class="feather-icon"></i>', array('class' => 'btn btn-danger btn-sm','type' => 'button' ,'data-bs-toggle' => 'modal', 'data-bs-target' => '#al-danger-alert', 'data-bs-id' => $user->id, 'data-bs-title' => __('Report User'), 'data-bs-message' => __('laravelusers::modals.delete_user_message', ['user' => $user->name]))) !!}
							{!! Form::close() !!}
						@endif
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
							<h4 class="mt-2">Report User</h4>
							<p class="mt-3">Are you sure, you want to report this user {{$user->name}} {{$user->lastname}}?</p>
							<form action="{{route('report.user', $user->id)}}" method="post" class="userDeleteForm">
								<input type="hidden" name="_method" value="POST" />
								@csrf
								<input class="form-control" type="text" name="message" placeholder="Type your reason" />
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

	@include('layouts/footer')
</div>
@endsection
