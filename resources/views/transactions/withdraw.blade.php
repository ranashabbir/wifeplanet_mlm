@extends('layouts.index')
@section('title')
    {{ __('Withdraw Money') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $deposit }}</h1>
                                        <h6 class="text-muted">All Deposits</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="20%" class="css-bar mb-0 css-bar-primary css-bar-20"><i class="mdi mdi-account-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $bonus }}</h1>
                                        <h6 class="text-muted">All Bonus</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="30%" class="css-bar mb-0 css-bar-danger css-bar-20"><i class="mdi mdi-briefcase-check"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $purchase }}</h1>
                                        <h6 class="text-muted">All Spent</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="40%" class="css-bar mb-0 css-bar-warning css-bar-40"><i class="mdi mdi-star-circle"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card card-body">
                                <div class="row pt-2 pb-2">
                                    <div class="col pr-0">
                                        <h1 class="fw-light">{{ $withdrawn }}</h1>
                                        <h6 class="text-muted">All WithDrawn</h6></div>
                                    <div class="col text-end align-self-center">
                                        <div data-label="60%" class="css-bar mb-0 css-bar-info css-bar-60"><i class="mdi mdi-receipt"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                $maxAmount = 50;
                $availableAmount = ($deposit+$bonus)-($withdrawn+$purchase);

                if ($availableAmount > 50) {
                    $maxAmount = $availableAmount;
                }
            @endphp
            <div class="animated fadeIn">
                @include('coreui-templates::common.errors')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    {!! __('Withdraw Money') !!}
                                    <div class="pull-right">
                                        Available to withdraw:
                                        <b>
                                            @if($availableAmount > 0)
                                                {{ number_format( (float) $availableAmount, 2, '.', '') }}
                                            @else
                                                0.00
                                            @endif
                                        </b>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Auth::user()->crypto == '' || Auth::user()->crypto == null)
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="alert alert-warning">
                                            Please add crypto wallet address from your profile to withdraw money. <a href="{{ url('profile/'.Auth::user()->id.'/edit') }}" class="btn btn-sm btn-default float-right">Add Crypto Address</a>
                                        </div>
                                    </div>
                                @endif
                                {!! Form::open(['route' => 'transactions.update']) !!}
                                    {!! Form::hidden('type', 'withdraw') !!}
                                    {!! Form::hidden('has_crypto', Auth::user()->crypto != '' && Auth::user()->crypto != null ? 1 : 0) !!}
                                    {!! Form::hidden('available', $availableAmount) !!}
                                    <!-- Commission Field -->
                                    <div class="form-group col-sm-12 col-lg-12">
                                        {!! Form::label('amount', 'Amount') !!}
                                        {!! Form::number('amount', null, ['min' => 50,'class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group col-sm-12 col-lg-12">
                                        <div class="d-md-flex align-items-center mt-3">
                                            <div class="form-check">
                                              <input class="form-check-input" type="checkbox" name="confirm" value="" id="flexCheckDefault">
                                              <label class="form-check-label" for="flexCheckDefault">
                                                {{ __('I confirm that I am responsible for setting correct crypto wallet address.') }}
                                              </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12">
                                        @if (Auth::user()->crypto != '' && Auth::user()->crypto != null)
                                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                        @endif
                                        <a href="{{ route('transactions') }}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts/footer')
    </div>
@endsection