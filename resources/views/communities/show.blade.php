@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | ' . $community->name }}
@endsection

@section('info')
    @include('layouts.partials.info')
@endsection

@section('content')
    <div class="flex border border-grey-light-alt hover:border-grey rounded bg-white mb-3">
        <div class="w-full">
            <div class="rounded bg-white mb-1">
                <div class="p-3">
                    <div class="h-8 -m-3 bg-no-repeat bg-100% community-cover"
                        style="background-color: {{ $community->color_palette['1'] }}">
                    </div>
                    <div>
                        <div class="inline-flex items-center">
                            @if (file_exists(public_path('storage/communities/' . $community->id . '/thumbnail_' . $community->logo)))
                                <img src="{{ asset('storage/communities/' . $community->id . '/thumbnail_' . $community->logo) }}"
                                    class="-mt-3 rounded-full border border-1 border-grey-lighter community-logo ">
                            @else
                                <img src="{{ asset('storage/communities/default.png') }}"
                                    class="-mt-3 rounded-full border border-1 border-grey-dark community-logo">
                            @endif
                        </div>
                        <div class="text-center profile-username mb-3 ">
                            <p class="text-3xl font-bold text-black mt-4 ">
                                {{ $community->name }}
                                @if ($community->verified)
                                    <i class="fas fa-badge-check text-blue"></i>
                                @endif
                            </p>
                            <span class="text-lg mt-2 text-grey">dir/{{ $community->slug }}</span>
                        </div>
                    </div>
                </div>
                {{-- {{ dd($color_pallete['0']) }} --}}
                <div class="text-center text-grey -mt-4">
                    @if (!$isJoinedCommunity)
                        <form action="{{ route('join', $community->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn btn-blue text-white bg-blue-dark hover:text-white rounded-pill btn-xs mx-1 mb-3"
                                style="background-color:#03a0e8">
                                <i class="far fa-sign-in"></i> Join Community
                            </button>
                        </form>
                    @else
                        @can('manage-community', $community)
                            <div class="d-block">
                                <a href="{{ route('communities.edit', $community) }}"
                                    class="btn btn-blue text-white bg-blue-dark hover:text-white rounded-pill btn-xs mx-1 mb-3"
                                    style="background-color:#03a0e8">
                                    <i class="fad fa-cogs"></i> Manage Community
                                </a>
                            </div>
                        @else
                            <form action="{{ route('leave', $community->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger rounded-pill bg-red-dark rounded mx-1 mb-3">
                                    <i class="far fa-sign-out"></i> Leave Community
                                </button>
                            </form>
                        @endcan
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="flex border border-grey-light-alt hover:border-grey rounded bg-white mb-3">
        <div class="w-11/12 px-1">
            <div class="inline-flex items-center my-2">
                <a href="{{ route('communities.show', $community) }}"
                    class="flex hover:bg-grey-lighter rounded p-1 ml-2 no-underline">
                    <span class="ml-2 text-sm font-semibold text-grey-darker ">
                        <div @if (request('sort', '') == '') style="color:#03a7f3" @endif>
                            <i class="fas fa-certificate"></i>
                            Newest Posts
                        </div>
                    </span>
                </a>
                <a href="{{ route('communities.show', $community) }}?sort=popular"
                    class="flex hover:bg-grey-lighter rounded p-1 ml-2 no-underline	">
                    <span class="ml-2 text-sm font-semibold text-grey-darker ">
                        <div @if (request('sort', '') == 'popular') style="color:#03a7f3" @endif>
                            <i class="fad fa-fire"></i>
                            Hottest Posts
                        </div>
                    </span>
                </a>

                @if ($isJoinedCommunity)
                    <a href="{{ route('communities.posts.create', $community) }}"
                        class="flex hover:bg-grey-lighter rounded p-1 ml-2 no-underline	">
                        <span class="ml-2 text-sm font-semibold text-grey-darker ">
                            <div>
                                <i class="fas fa-plus"></i>
                                Create Post
                            </div>
                        </span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    @forelse ($posts as $index => $post)
        @include('components.post-card', $post)
    @empty
        <h4 class="text-center text-secondary ">
            <i class="fad fa-sticky-note fa-2x my-3"></i>
            <p>No Posts in this community yet</p>
        </h4>
    @endforelse

    <div class="justify-content-center pagination">
        {{ $posts->links() }}
    </div>
@endsection
