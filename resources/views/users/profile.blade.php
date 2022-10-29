@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | ' . $user->name }}
@endsection

@section('info')
    @include('layouts.partials.user')
@endsection

@section('content')
    <div class="flex border border-grey-light-alt hover:border-grey rounded bg-white mb-3">
        <div class="w-full">
            <div class="rounded bg-white mb-1">
                <div class="p-1">
                    <div class="bg-no-repeat bg-100% profile-cover"></div>
                    <div class="p-2">
                        <div class="inline-flex items-center">
                            @if (file_exists(public_path('storage/users/' . $user->id . '/thumbnail_' . $user->avatar)))
                                <img src="{{ asset('storage/users/' . $user->id . '/thumbnail_' . $user->avatar) }}"
                                    class="-mt-3 rounded-full border border-4 border-white profile-img">
                            @else
                                <img class="-mt-3 h-16 rounded-full border profile-img"
                                    src="{{ asset('storage/users/default.png') }}">
                            @endif
                        </div>
                        <div class="text-center profile-username">
                            <p class="text-3xl font-bold leading-normal  text-black mt-4">
                                {{ $user->name }}
                            </p>
                            <span class="text-lg mt-4  text-grey">u/{{ $user->username }}</span>
                        </div>
                    </div>
                </div>
                <div class="text-center text-grey mb-4">
                    @auth
                        @if (Auth::user()->id == $user->id)
                            <div class="mt-2">
                                <a href="{{ route('profile.edit') }}"
                                    class="btn btn-blue text-white bg-blue-dark hover:text-white rounded-pill btn-xs mx-1"
                                    style="background-color:#03a0e8">
                                    <i class="fad fa-user-cog"></i> Edit My Profile
                                </a>
                            </div>
                        @else
                            @auth
                                <form action="{{ route('user.report', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-blue text-white bg-blue-dark hover:text-white rounded-pill btn-xs mx-1"
                                        style="background-color:#03a0e8">
                                        <i class="fas fa-flag-alt"></i> Report User
                                    </button>
                                </form>
                            @endauth
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="flex border border-grey-light-alt rounded bg-white mb-3 text-center">
        <div class="w-full px-1">
            <div class="inline-flex items-center my-1">
                <a class="flex  rounded p-1 no-underline">
                    <span class="text-md  text-grey">
                        <div>
                            <span class="mt-2 font-semibold">
                                <i class="fas fa-certificate"></i>
                                @if (auth()->id() == $user->id)
                                    My latest posts
                                @else
                                    {{ $user->name }}'s latest posts
                                @endif
                            </span>
                        </div>
                    </span>
                </a>
            </div>
        </div>
    </div>
    @forelse ($posts as $index => $post)
        @include('components.post-card', $post)
    @empty
        <h4 class="text-center text-secondary ">
            <i class="fad fa-sticky-note fa-2x my-3"></i>
            <p>No Posts for this user</p>
        </h4>
    @endforelse
@endsection
