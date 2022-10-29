<div class="flex border border-grey-light-alt hover:border-grey rounded bg-white mb-3">
    @livewire('post-vote', ['post' => $post])
    <div class="w-11/12 pt-2">
        <div class="flex items-center text-xs mb-2">
            <a href="{{ route('communities.show', $post->community->slug) }}"
                class="font-semibold no-underline hover:underline text-black flex items-center">
                @if (file_exists(public_path('storage/communities/' . $post->community->id . '/thumbnail_' . $post->community->logo)))
                    <img class="rounded-full border h-5 w-5"
                        src="{{ asset('storage/communities/' . $post->community->id . '/thumbnail_' . $post->community->logo) }}">
                @else
                    <img class="rounded-full border h-6 w-6 mr-1" style="width:2rem;height:2rem"
                        src="{{ asset('storage/communities/default.png') }}">
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
            <h2 class="text-xl mb-1 mt-1 text-grey-darkest"> {{ $post->title }} </h2>
        </div>

        @if ($post->post_url != '')
            <div class="mb-3 mt-2">
                <a class="mb-5 no-underline text-blue-dark" href="{{ $post->post_url }}" target="_blank">
                    {{ Str::limit($post->post_url, 30, '...') }} <i class="fas fa-external-link"></i>
                </a>
            </div>
        @endif

        @if ($post->post_image != '')
            <a href="{{ route('communities.posts.show', [$post->slug]) }}">
                <img src="{{ asset('storage/posts/' . $post->id . '/thumbnail_' . $post->post_image) }}"
                    class="img-fluid">
            </a>
        @endif
        <div>
            <h2 class="text-lg font-medium text-grey-darker mt-2 mb-1"> {!! Str::limit($post->post_text, 60, '...') !!}</h2>
        </div>
        <div class="inline-flex items-center my-2">
            <div class="flex hover:bg-grey-lighter p-1">
                <a href="{{ route('communities.posts.show', [$post->slug]) }}" class="no-underline">
                    <svg class="w-4 fill-current text-grey" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path
                            d="M10 15l-4 4v-4H2a2 2 0 0 1-2-2V3c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-8zM5 7v2h2V7H5zm4 0v2h2V7H9zm4 0v2h2V7h-2z" />
                    </svg>
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
                <button type="button" data-bs-toggle="modal" data-bs-target="#postModal-{{ $index }}"
                    class="no-underline">
                    <span class="ml-2 text-xs font-semibold text-grey">Share</span>
                </button>
            </div>
            @include('layouts.partials.modal')
            <a href="{{ route('communities.posts.show', [$post->slug]) }}"
                class="flex hover:bg-grey-lighter p-1 ml-2 no-underline">

                <span class="ml-2 text-xs font-semibold text-grey">Read more
                    <i class="fas fa-ellipsis-h"></i>
                </span>
            </a>
        </div>
    </div>
</div>
