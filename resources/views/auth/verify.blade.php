@extends('FrontEnd.layouts.master')
@section('content')

<section id="header-section">
    <div class="header-info">
        <div class="container">
            <a href="{{ route('fronthome') }}"><img src="{{ asset('image/logo/'.config('company.main_logo')) }}"
                    class="img-responsive center-block d-block mx-auto" alt="{{ config('company.company_name') }}"></a>
        </div>
    </div>
</section>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit"
                            class="btn btn-success align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection