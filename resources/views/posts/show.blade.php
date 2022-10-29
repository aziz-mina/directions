@extends('layouts.app')

@section('title')
    {{ config('app.name') . ' | ' . $post->user->name . 's post' }}
@endsection

@section('content')

    <div class="flex border border-grey-light-alt hover:border-grey rounded bg-white cursor-pointer mb-3 mt-2">
        <div class="w-full">
            <div class="inline-flex items-center">
                <nav aria-label="breadcrumb ">
                    <ol class="default-breadcrumb mt-2 -ml-5">
                        <li class="crumb">
                            <div class="bredcrumb-link">
                                <a href="{{ route('home') }}">
                                    <a href="{{ route('home') }}" class="fa fa-home"></a>
                                </a>
                            </div>
                        </li>
                        <li class="crumb">
                            <div class="bredcrumb-link">
                                <a href="{{ route('communities.show', $post->community->slug) }}">{{ $post->community->name }}
                                    Community
                                </a>
                            </div>
                        </li>
                        <li class="crumb active">
                            <div class="bredcrumb-link">
                                <span aria-current="location">
                                    @if (auth()->id() == $post->user_id)
                                        Your post
                                    @else
                                        {{ $post->user->name }}
                                        's post
                                    @endif
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="flex border border-grey-light-alt hover:border-grey rounded bg-white mb-3">
        @livewire('post-vote', ['post' => $post])
        <div class="w-11/12 pt-2">
            <div class="flex items-center text-xs mb-2">
                <a href="{{ route('communities.show', $post->community->slug) }}"
                    class="font-semibold no-underline hover:underline text-black flex items-center">

                    @if (file_exists(public_path('storage/communities/' . $post->community->id . '/thumbnail_' . $post->community->logo)))
                        <img src="{{ asset('storage/communities/' . $post->community->id . '/thumbnail_' . $post->community->logo) }}"
                            class="rounded-full border h-5 w-5">
                    @else
                        <img class="rounded-full border h-5 w-5" src="{{ asset('storage/communities/default.png') }}">
                    @endif

                    <span class="ml-2 mx-1">dir/{{ $post->community->name }}</span>
                </a>
                <span class="text-grey text-sm"> </span>
                <span class="text-grey mx-1">Posted by </span>
                <a href="{{ route('users.show', $post->user->username) }}"
                    class="text-grey mx-1 no-underline hover:underline">u/{{ $post->user->name }}</a>
                <span class="text-grey mx-1">
                    <i class="far fa-clock"></i>
                    {{ $post->created_at->diffForHumans() }}
                </span>
            </div>
            <div class="my-3">
                <h2 class="text-2x mb-1 mt-1"> {{ $post->title }} </h2>
            </div>

            @if ($post->post_url != '')
                <div class="mb-3 mt-2">
                    <a class="mb-5 no-underline text-blue-dark" href="{{ $post->post_url }}" target="_blank">
                        {{ Str::limit($post->post_url, 30, '...') }} <i class="fas fa-external-link"></i>
                    </a>
                </div>
            @endif

            @if ($post->post_image != '')
                <img src="{{ asset('storage/posts/' . $post->id . '/thumbnail_' . $post->post_image) }}" class="img-fluid">
            @endif


            <div>
                <h2 class="text-lg font-medium mr-5 my-3 text-grey-darker"> {!! $post->post_text !!}</h2>
            </div>
            <div class="inline-flex items-center my-1 mb-3">
                <div class="flex hover:bg-grey-lighter p-1">
                    <svg class="w-4 fill-current text-grey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z" />
                    </svg>
                    <a href="#" class="no-underline">
                        <span class="ml-2 text-xs font-semibold text-grey">{{ $post->comments->count() }}
                            Comments
                        </span>
                    </a>
                </div>
                <div class="flex hover:bg-grey-lighter p-1 ml-2">
                    <svg class="w-4 fill-current text-grey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M5.08 12.16A2.99 2.99 0 0 1 0 10a3 3 0 0 1 5.08-2.16l8.94-4.47a3 3 0 1 1 .9 1.79L5.98 9.63a3.03 3.03 0 0 1 0 .74l8.94 4.47A2.99 2.99 0 0 1 20 17a3 3 0 1 1-5.98-.37l-8.94-4.47z" />
                    </svg>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#postModal" class="no-underline">
                        <span class="ml-2 text-xs font-semibold text-grey">Share</span>
                    </button>
                </div>

                @can('edit-post', $post)
                    <a href="{{ route('communities.posts.edit', [$post->community, $post]) }}"
                        class="flex hover:bg-grey-lighter p-1 ml-2 no-underline">
                        <span class="ml-2 text-xs font-semibold text-grey">
                            <i class="fas fa-edit mx-1"></i> Edit Post
                        </span>
                    </a>
                @endcan

                @can('delete-post', $post)
                    <form action="{{ route('communities.posts.destroy', [$post->community, $post]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex hover:bg-grey-lighter p-1 ml-2 no-underline">
                            <span class="ml-2 text-xs font-semibold text-grey">
                                <i class="fa fa-trash mx-1"></i> Delete Post
                            </span>
                        </button>
                    </form>
                @else
                    @auth
                        @if ($isJoinedCommunity)
                            <form action="{{ route('post.report', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex hover:bg-grey-lighter p-1 ml-2 no-underline">
                                    <span class="ml-2 text-xs font-semibold text-grey">
                                        <i class="fa fa-flag-alt mx-1"></i> Report post
                                    </span>
                                </button>
                            </form>
                        @endif
                    @endauth
                @endcan
            </div>
        </div>
    </div>
    @auth
        <div>
            @if ($isJoinedCommunity)
                <form method="POST" action="{{ route('posts.comments.store', $post) }}">
                    @csrf
                    <textarea class="form-control bg-white" name="comment_text" placeholder="What are Your Thoughts ?" rows="5"
                        required></textarea>
                    <button type="submit" class="btn btn-primary rounded-3 my-3"> <i class="fad fa-comment-alt-dots mx-1"></i>
                        Comment
                    </button>
                </form>
            @else
                <h4 class="text-center text-secondary">
                    <p>Join to Community to comment </p>

                    <form action="{{ route('join', $post->community_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary rounded my-3">
                            <i class="far fa-sign-in"></i> {{ __('Join Community') }}
                        </button>
                    </form>
                </h4>
            @endif

            @if ($post->comments->isEmpty())
                <h4 class="text-center text-secondary">
                    <i class="fas fa-comment-alt-times fa-2x mt-3"></i>
                    <p class="mt-2">No Comments yet</p>
                </h4>
            @else
                <h5 class="my-2">Comments</h5>
                @foreach ($post->comments as $comment)
                    <div
                        class="flex-col w-full py-4 mx-auto mt-2 bg-white border-b-2 border-r-2 border-gray-200 sm:px-4 sm:py-4 md:px-4 sm:rounded-lg sm:shadow-sm">
                        <div class="flex flex-row md-10">

                            @if (file_exists(public_path('storage/users/' . auth()->id() . '/thumbnail_' . Auth::user()->avatar)))
                                <img src="{{ asset('storage/users/' . auth()->id() . '/thumbnail_' . Auth::user()->avatar) }}"
                                    class="w-12 h-12 border-2 border-gray-300 rounded-full" alt="post's avatar">
                            @else
                                <img class="w-12 h-12 border-2 border-gray-300 rounded-full" alt="post's avatar"
                                    src="{{ asset('storage/users/default.png') }}">
                            @endif

                            <div class="flex-col mt-1">
                                <div class="flex items-center flex-1 px-3 font-bold leading-tight">{{ $comment->user->name }}
                                    <span class="ml-2 text-xs font-normal text-gray-500">
                                        <i class="far fa-clock"></i> {{ $comment->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <div class="flex-1 px-2 ml-2 text-sm font-medium leading-loose text-gray-600">
                                    {{ $comment->comment_text }}
                                </div>

                                @can('delete-comment', $comment)
                                    <form action="{{ route('posts.comments.destroy', [$comment->user, $comment]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-1 -ml-1 flex-column">
                                            <span class="mx-3 mt-3 text-red"><i class="fad fa-trash "></i> Delete</span>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    @endauth
    @guest
        <h4 class="text-center text-secondary" style="">
            <p>Please Login to Comment </p>
            <a href="{{ route('login') }}" class="btn btn-primary rounded-3 my-3"><i class="fad fa-sign-in"></i>
                {{ __('Login') }}
            </a>
        </h4>
    @endguest
    @include('layouts.partials.modal')
@endsection
