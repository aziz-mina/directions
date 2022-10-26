<div class="relative navbar-nav mx-auto my-2">
    <form class="inline">
        <input id="search-box" type="text" placeholder="Search" autocomplete="off" wire:model.debounce.500ms="query"
            wire:keydown.escape="query_reset" />
        <button id="search-btn">
            <i class="fal fa-search"></i>
        </button>
    </form>

    <div wire:loading class="spinner top-0 right-0 ml-4 mr-2 mt-3"></div>

    @if (!empty($query) && strlen($query) >= 3)
        <div class="absolute w-full bg-white rounded-t-none shadow-lg list-group mt-10 z-9">
            @if (!empty($communities))
                <p
                    class="dropdown-item text-grey-dark hover:bg-white hover:text-grey-dark px-2 mt-2 mb-3 ml-1 text-left text-lg">
                    <i class="fad fa-users-crown"></i> {{ __('Communities') }}
                </p>

                @foreach ($communities as $community)
                    <a href="{{ route('communities.show', $community['slug']) }}"
                        class="list-item no-underline text-left ml-6 text-dark font-weight-light mb-3">
                        @if (file_exists(public_path('storage/communities/' . $community['id'] . '/thumbnail_' . $community['logo'])))
                            <img class="rounded-full border result-img mr-1"
                                src="{{ asset('storage/communities/' . $community['id'] . '/thumbnail_' . $community['logo']) }}">
                        @else
                            <img class="rounded-full border result-img mr-1"
                                src="{{ asset('storage/communities/default.png') }}">
                        @endif
                        <span> {{ $community['name'] }} </span>
                    </a>
                @endforeach
            @endif
            @if (!empty($users))
                <p
                    class="dropdown-item text-grey-dark hover:bg-white hover:text-grey-dark px-2 mt-2 mb-3 ml-1 text-left text-lg">
                    <i class="fal fa-user-circle"></i> {{ __('Users') }}
                </p>
                @foreach ($users as $user)
                    <a href="{{ route('users.show', $user['username']) }}"
                        class="list-item no-underline text-left ml-6 text-dark font-weight-light mb-3">
                        @if (file_exists(public_path('storage/users/' . $user['id'] . '/thumbnail_' . $user['avatar'])))
                            <img class="rounded-full border result-img mr-1"
                                src="{{ asset('storage/users/' . $user['id'] . '/thumbnail_' . $user['avatar']) }}">
                        @else
                            <img class="rounded-full border result-img mr-1"
                                src="{{ asset('storage/users/default.png') }}">
                        @endif
                        <span>{{ $user['name'] }}</span>
                    </a>
                @endforeach
            @endif
            @if (!empty($posts))
                <p
                    class="dropdown-item text-grey-dark hover:bg-white hover:text-grey-dark px-2 mt-2 mb-3 ml-1 text-left text-lg">
                    <i class="fad fa-sticky-note"></i> {{ __('Posts') }}
                </p>
                @foreach ($posts as $post)
                    <a href="{{ route('communities.posts.show', $post['slug']) }}"
                        class="list-item text-left ml-6 no-underline text-dark font-weight-light mb-3">
                        <span><i class="fad fa-search mr-1 text-grey-dark"></i>
                            {{ Str::limit($post['title'], 37, '...') }}</span>
                    </a>
                @endforeach
            @endif
            @if (empty($posts) && empty($users) && empty($communities))
                <img src="{{ URL::to('/') }}/no-search-result.webp" class="mx-auto my-3 h-6 w-6"></i>
                <span class="text-center text-grey-dark mb-2"> No Search result for '{{ $query }}'</span>
            @endif
        </div>
    @endif
</div>
