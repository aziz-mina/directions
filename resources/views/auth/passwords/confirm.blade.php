@extends('layouts.auth')

@section('title') {{ config('app.name').' | Email Reset ' }} @endsection

@section('content')
        <form class="login-form" method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="form-header">
                <img class="logo" src="{{ asset('favicon.png') }}">
                <h3>{{ __('Confirm Password') }}</h3>
            </div>

            <p>{{ __('Please confirm your password before continuing.') }}</p>

            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-success d-block form-control" type="submit" name="login"><i class="far fa-sign-in"></i>  {{ __('Confirm Password') }}</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
@endsection