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

    					<img src="@if ($user->profile && $user->profile->avatar) {{ $user->profile->avatar }} @else {{ Gravatar::get($user->email) }} @endif" alt="{{ $user->name }}" class="user-avatar">

						<dl class="user-info">

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
								{{ __('Parent Account') }}
							</dt>
							<dd>
								{{ $user->parent->name }} {{ $user->parent->lastname }}
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

						<a href="{{ route('profile.edit', [$user->profile->id]) }}" class="btn btn-sm btn-primary">Edit Profile</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('layouts/footer')
</div>
@endsection
