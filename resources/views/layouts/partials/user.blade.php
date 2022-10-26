<div class="card" id="home-page">
    <div class="rounded bg-white mb-1">
        <div class="p-3">
            <div class="w-0-5 -m-3 bg-no-repeat bg-100% info-background">
            </div>
            <div class="text-center">
                <div class="items-center mt-4">
                    @if (file_exists(public_path('storage/users/' . $user->id . '/thumbnail_' . $user->logo)))
                        <img class="info-image"
                            src="{{ asset('storage/users/' . $user->id . '/thumbnail_' . $user->logo) }}">
                    @else
                        <img class="info-image" src="{{ asset('storage/users/default.png') }}">
                    @endif
                </div>
                <div class="inline-flex items-center">
                    <span class="text-lg mt-2">{{ $user->name }}</span>
                </div>

                <p class="text-center mb-1">
                    <span class="text-grey-dark">
                        u/{{ $user->username }}
                    </span>
                </p>

                <p class="text-center">
                    <i class="fad fa-stopwatch text-grey-dark"></i>
                    <span class="text-grey-dark">Joined
                        {{ $user->created_at->diffForHumans() }}
                    </span>
                </p>
                <hr class="text-grey-dark">
                <div class="user-details text-grey-dark">
                    <div class="column">
                        <h4>{{ $user->posts->count() }}</h4>
                        <span>Total Posts</span>
                    </div>
                    <div class="column">
                        <h4>{{ count($user->communities) }}</h4>
                        <span>Communities</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
