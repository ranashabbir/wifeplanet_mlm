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
                                {!! Form::open(['route' => 'transactions.update']) !!}
                                    {!! Form::hidden('type', 'withdraw') !!}
                                    {!! Form::hidden('available', $availableAmount) !!}
                                    <!-- Commission Field -->
                                    <div class="form-group col-sm-12 col-lg-12">
                                        {!! Form::label('amount', 'Amount') !!}
                                        {!! Form::number('amount', null, ['min' => 50,'class' => 'form-control']) !!}
                                    </div>

                                    <!-- Submit Field -->
                                    <div class="form-group col-sm-12">
                                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
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