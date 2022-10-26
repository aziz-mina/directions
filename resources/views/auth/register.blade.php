@extends('layouts.auth')

@section('title')
    {{ config('app.name') . ' | Register' }}
@endsection

@section('content')
    <form class="login-form" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-header">
            <img class="logo" src="{{ asset('favicon.png') }}">
            <h3>Directions</h3>
        </div>

        <div class="form-group">
            <input id="name" type="text" placeholder="Your Name"
                class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="form-group">
            <input id="email" type="email" placeholder="Your Email"
                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                required autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="username" type="text" placeholder="Your username"
                class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"
                required autocomplete="username">
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password" type="password" placeholder="Your password"
                class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <input id="password-confirm" type="password" placeholder="Confirm password" class="form-control"
                name="password_confirmation" required autocomplete="new-password">
        </div>

        <div class="form-group">
            <button class="btn btn-success d-block form-control" type="submit" name="login"><i
                    class="far fa-sign-in"></i> {{ __('Register') }} </button>
        </div>
        <h6 class="footer-text">Already have account ? <a href="{{ route('login') }}">Login</a></h6>

        {{-- <h6 class="footer-me" >Developed By <i style="color:red" class="fa fa-heart"></i> Mina Isaac</h6> --}}

    </form>
@endsection
