@extends('layouts.auth')

@section('title')
    {{ config('app.name') . ' | Email ' }}
@endsection

@section('content')
    <form class="login-form" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-header">
            <img class="logo" src="{{ asset('favicon.png') }}">
            <h3>Directions</h3>
            <h6>{{ __('Reset Your Password') }}</h6>
        </div>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="form-group">
            <input id="email" type="email" placeholder="Enter Your Email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-success d-block form-control" type="submit" name="login"><i
                    class="fad fa-paper-plane"></i> {{ __('Send Password Reset Link') }}</button>
        </div>

        <h6 class="footer-text">Remember Your Password ? <a href="{{ route('login') }}">Login</a></h6>

    </form>
@endsection
