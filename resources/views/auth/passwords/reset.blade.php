@extends('layouts.auth')

@section('title')
    {{ config('app.name') . ' | Reset Password' }}
@endsection

@section('content')
    <form class="login-form" method="POST" action="{{ route('password.update') }}">
        @csrf
        <div class="form-header">
            <img class="logo" src="{{ asset('favicon.png') }}">
            <h3>Directions</h3>
            <h5>{{ __('Reset Your Password') }}</h5>
        </div>

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <input id="email" type="email" placeholder="Your Email"
                class="form-input form-control @error('email') is-invalid @enderror" name="email"
                value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" placeholder="New Password"
                class="form-input form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password-confirm" type="password" placeholder="Confirm New Password" class="form-input form-control"
                name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-group">
            <button class="btn btn-success d-block form-control" type="submit" name="login"><i class="far fa-check"></i>
                {{ __('Reset Password') }}</button>
        </div>
    </form>
@endsection
