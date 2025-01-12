@extends('layouts.app')

@section('content')
<div class="form-container">
    <h2 class="form-title">{{ __('Verify Your Email Address') }}</h2>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <p class="form-text">
        {{ __('Before proceeding, please check your email for a verification link.') }}
        <br>
        {{ __('If you did not receive the email') }},
    </p>

    <form class="auth-form" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="auth-button">{{ __('Click here to request another') }}</button>
    </form>
</div>
@endsection
