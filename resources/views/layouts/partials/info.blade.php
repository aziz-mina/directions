<div class="card" id="home-page">
    <div class="rounded bg-white mb-1">
        <div class="p-3">
            <div class="w-0-5 -m-3 bg-no-repeat bg-100% info-background">
            </div>
            <div class="text-center">
                <div class="inline-flex items-center">
                    <span class="text-lg ml-4 mt-6 mb-3">About Community</span>
                </div>
                <p class="font-normal mb-3 text-sm leading-normal text-center">
                    {{ $community->description }}

                </p>
                <ul class="topics mb-2">
                    @foreach ($community->topics as $topic)
                        <li class="d-inline-flex flex-column"><a href="#" class="topic">{{ $topic->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <p class="text-center">
                    <i class="fad fa-stopwatch text-grey-dark"></i>
                    <span class="text-grey-dark">Created
                        {{ $community->created_at->diffForHumans() }}
                    </span>
                </p>
                <hr class="text-grey-dark">
                <div class="details text-grey-dark">
                    <div class="column">
                        <h4>{{ count($community->userCommunity) }}</h4>
                        <span>Total Members</span>
                    </div>
                    <div class="column">
                        <h4>{{ count($posts) }}</h4>
                        <span>Total Posts</span>
                    </div>
                </div>

                @if ($isJoinedCommunity)
                    <a href="{{ route('communities.posts.create', $community) }}"
                        class="btn btn-blue text-white bg-blue-dark hover:bg-blue-dark text-sm text-white font-semibold rounded px-4 py-2 w-full">Create
                        Post
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
