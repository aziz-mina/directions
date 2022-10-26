@extends('layouts.auth')

@section('title') {{ config('app.name').' | Verify' }} @endsection

@section('content')
        <form class="login-form" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <div class="form-header">
                <img class="logo" src="{{ asset('favicon.png') }}">
                <h3>Directions</h3>
                <h6>{{ __('Verify Your Email Address') }}</h6>
            </div>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }}
            
            <div class="form-group mt-4">
                <button class="btn btn-success d-block form-control" type="submit" > {{ __('click here to request another') }} </button>
            </div>
        </form>
@endsection