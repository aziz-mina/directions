@extends('layouts.auth')

@section('title')
    {{ config('app.name') . ' | Login' }}
@endsection

@section('content')
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-header">
            <img class="logo" src="{{ asset('favicon.png') }}">
            <h3>Directions</h3>
        </div>

        <div class="form-group">
            <input id="email" type="email" placeholder="Your Email"
                class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Your Password" name="password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input class="form-check-input remember-check mt-2" role="button" type="checkbox" name="remember"
                id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label remember-txt" role='button' for="remember">
                {{ __('Keep me logged for next time') }}
            </label>
        </div>

        <div class="form-group">
            <button class="btn btn-success d-block form-control" type="submit" name="login"><i
                    class="far fa-sign-in"></i> {{ __('Login') }} </button>
        </div>
        <h6 class="footer-text">Don't have account ? <a class="text-xs" href="{{ route('register') }}">Create an
                account</a></h6>
        <h6 class="footer-reset">Forget Your password ? <a href="{{ route('password.request') }}">Reset it</a></h6>
    </form>
@endsection
