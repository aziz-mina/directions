<div class="card mt-2" id="trending-communities">
    <div class="rounded bg-white mb-3">
        <div class="p-3">
            <div class="h-8 -m-3 bg-no-repeat bg-100%" style="background-image: url('/banner-posts.jpg');">
            </div>
            <div>
                <div class="inline-flex items-center">
                    <img src="/avatars/1.png" class="h-16">
                    <span class="text-lg ml-4 mt-6">dir/Trending Community</span>
                </div>

                @if (count($trendingCommunities) > 0)
                    <div class="my-2">
                        @foreach ($trendingCommunities as $community)
                            <hr class="text-grey-dark">
                            <div class="px-2 py-2">
                                <div class="flex">
                                    @if (file_exists(public_path('storage/communities/' . $community->id . '/thumbnail_' . $community->logo)))
                                        <img class="com-logo border rounded-full"
                                            src="{{ asset('storage/communities/' . $community->id . '/thumbnail_' . $community->logo) }}">
                                    @else
                                        <img class="com-logo border rounded-full"
                                            src="{{ asset('storage/communities/default.png') }}">
                                    @endif
                                    <div class="flex flex-col font-medium ml-1">
                                        <a href="{{ route('communities.show', $community) }}"
                                            class="text-sm text-black-alt no-underline leading-tight"> dir/
                                            {{ $community->name }}
                                        </a>
                                        <span class="text-xs text-grey-dark mt-1"> <i class="fad fa-users-crown"></i>
                                            {{ count($community->userCommunity) }}
                                            members
                                        </span>
                                    </div>
                                    <div class="flex ml-auto">
                                        <a href="{{ route('communities.show', $community) }}"
                                            class="btn btn-blue text-white bg-blue-dark hover:bg-blue-dark float-right rounded mb-3">Join</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4 class="text-center text-secondary  my-4">
                        <i class="fad fa-users-crown my-2"></i>
                        <p class="text-base">No communities yet</p>
                    </h4>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mt-2" id="trending-posts">
    <div class="rounded bg-white mb-3">
        <div class="p-3">
            <div class="h-8 -m-3 bg-no-repeat bg-100%" style="background-image: url('/banner-3.webp');">
            </div>
            <div>
                <div class="inline-flex items-center">
                    <img src="/avatars/1.png" class="h-16">
                    <span class="text-lg ml-4 mt-6">dir/Trending Posts</span>
                </div>
                @if (count($newPosts) > 0)
                    <div class="my-2">
                        @foreach ($newPosts as $post)
                            <hr class="text-grey-dark">
                            <div class="px-2 py-2">
                                <div class="flex">
                                    @if (file_exists(public_path('storage/communities/' . $post->community->id . '/thumbnail_' . $post->community->logo)))
                                        <img class="rounded-full border com-logo"
                                            src="{{ asset('storage/communities/' . $post->community->id . '/thumbnail_' . $post->community->logo) }}">
                                    @else
                                        <img class="rounded-full border com-logo"
                                            src="{{ asset('storage/communities/default.png') }}">
                                    @endif
                                    <div class="flex flex-col font-medium ml-1">
                                        <a href="{{ route('communities.show', $community) }}"
                                            class="text-sm text-black-alt no-underline leading-tight"> dir/
                                            {{ $community->name }}
                                        </a>
                                        <span class="text-xs text-grey-dark mt-1">
                                            <i class="fad fa-stopwatch"></i>
                                            {{ $post->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <div class="flex ml-auto">
                                        <a href="{{ route('communities.posts.show', [$post->slug]) }}"
                                            class="btn btn-blue text-white bg-blue-dark hover:bg-blue-dark float-right rounded mb-3">Show</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4 class="text-center text-secondary  my-4">
                        <i class="fad fa-sticky-note my-2"></i>
                        <p class="text-base">No posts yet</p>
                    </h4>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card mt-2" id="trending-topics">
    <div class="rounded bg-white mb-3">
        <div class="p-3">
            <div class="h-8 -m-3 bg-no-repeat bg-100%" style="background-image: url('/banner-4.webp');">
            </div>
            <div>
                <div class="inline-flex items-center">
                    <img src="/avatars/1.png" class="h-16">
                    <span class="text-lg ml-4 mt-6">dir/Trending Topics</span>
                </div>

                @if (count($trendingTopics) > 0)
                    <hr class="text-grey-dark">
                    <ul class="topics">
                        @foreach ($trendingTopics as $topic)
                            <div class="p-1 d-inline-flex flex-column">
                                <span>
                                    <li><a href="{{ route('topics.show', $topic->id) }}"
                                            class="topic">{{ $topic->name }}</a></li>
                                </span>
                            </div>
                        @endforeach
                    </ul>
                @else
                    <h4 class="text-center text-secondary  my-4">
                        <i class="fad fa-sticky-note my-2"></i>
                        <p class="text-base">No Topics yet</p>
                    </h4>
                @endif
            </div>
        </div>
    </div>
</div>
