@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | Update Profile ' }}
@endsection

@section('content')

    {{ Breadcrumbs::render('editProfile') }}

    <div class="card">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link text-base active" href="#information" id="information-tab" data-bs-toggle="tab"
                        data-bs-target="#information" type="button" role="tab" aria-controls="information"
                        aria-selected="true"><i class="fad fa-sync"></i> Update Information </a>
                    <a class="nav-link text-base" href="#profile" id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false"> <i class="fad fa-user-circle"></i> Change Avatar</a>
                    <a class="nav-link text-base" href="#password" id="password-tab" data-bs-toggle="tab"
                        data-bs-target="#password" type="button" role="tab" aria-controls="password"
                        aria-selected="false"><i class="fad fa-unlock-alt"></i> Change Password</a>
                    <a class="nav-link text-base" href="#delete" id="delete-tab" data-bs-toggle="tab"
                        data-bs-target="#delete" type="button" role="tab" aria-controls="delete"
                        aria-selected="false"><i class="fad fa-trash"></i> Delete Account</a>
                </div>
            </nav>

            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                    <div class="head-text mt-5 mb-1">
                        <h2>Update Profile</h2>
                    </div>
                    <form method="POST" action="{{ route('profile.edit') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                Your Username
                                <input id="username" type="text" disabled class="mt-1 text-secondary form-control"
                                    name="username" value="{{ $user->username }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                Your name
                                <input id="name" type="text"
                                    class="bg-white mt-1 form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ $user->name }}" placeholder="Your name ( Required)" required>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                Your Email
                                <input id="email" type="email"
                                    class="bg-white mt-1 form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $user->email }}" placeholder="Your Email ( Required)">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit"
                                    class="btn btn-primary bg-blue-dark font-semibold rounded px-4 py-2 w-full">
                                    <i class="fad fa-sync fa-spin"></i> {{ __('Update Information') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="head-text mt-5 mb-1">
                        <h2>Update Avatar</h2>
                    </div>
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        <span class="text-center">
                            @if (file_exists(public_path('storage/users/' . auth()->id() . '/thumbnail_' . Auth::user()->avatar)))
                                <img src="{{ asset('storage/users/' . auth()->id() . '/thumbnail_' . Auth::user()->avatar) }}"
                                    class="rounded-full h-14 w-14 border m-auto d-block">
                            @else
                                <img class="rounded-full border img-fluid m-auto d-block"
                                    src="{{ asset('storage/users/default.png') }}">
                            @endif
                        </span>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                Your Avatar
                                <input id="avatar" class="bg-white form-control mt-1" type="file" name="avatar"
                                    accept="image/*" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit"
                                    class="btn btn-primary bg-blue-dark font-semibold rounded px-4 py-2 w-full">
                                    <i class="fad fa-sync fa-spin"></i> {{ __('Update Avatar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
                    <div class="head-text mt-5 mb-1">
                        <h2>Delete Profile</h2>
                    </div>
                    <form method="POST" action="{{ route('profile.delete') }}">
                        @csrf
                        <div class="text-center my-3">
                            <div class="text-xl my-2">
                                <i class="fad fa-engine-warning text-red-dark"></i>
                                <span class="text-red-dark my-4">warning</span>
                            </div>
                            <p>
                                Althought we will miss you , Please note that , You can delete your Directions Account at
                                any
                                time. But If you change your
                                mind,
                                you might not be able
                                to recover it later.
                            </p>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit"
                                    class="btn btn-danger bg-red-dark font-semibold rounded px-4 py-2 w-full">
                                    <i class="fad fa-trash"></i> {{ __('Delete account') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <div class="head-text mt-5 mb-1">
                        <h2>Change Password</h2>
                    </div>
                    <form method="POST" action="{{ route('profile.edit') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-12">
                                Old Password
                                <input id="old_password" type="password"
                                    class="bg-white mt-1 form-control @error('old_password') is-invalid @enderror"
                                    name="old_password" placeholder="Your Old Password" required>
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                New Password
                                <input id="new_password" type="password"
                                    class="bg-white mt-1 form-control @error('new_password') is-invalid @enderror"
                                    name="new_password" placeholder="Your New Password" required>
                                @error('new_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                Confirm Password
                                <input id="password-confirm" type="password" class="bg-white mt-1 form-control"
                                    name="password_confirmation" placeholder="Confirm New Password" required>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-12">
                                <button type="submit"
                                    class="btn btn-primary bg-blue-dark font-semibold rounded px-4 py-2 w-full">
                                    <i class="fad fa-sync fa-spin"></i> {{ __('Update password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
