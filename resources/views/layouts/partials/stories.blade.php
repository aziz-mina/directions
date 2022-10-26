@if (count($trendingPosts) > 0)
    <div class="text-center p-2 border border-grey-light-alt hover:border-grey rounded bg-white cursor-default mb-2">
        <div class="story owl-carousel owl-theme">
            @foreach ($trendingPosts as $post)
                <a href="{{ route('communities.posts.show', $post->slug) }}" class="no-underline mb-1">
                    <div class="story-item item"
                        style="background-image:url({{ asset('storage/posts/' . $post->id . '/thumbnail_' . $post->post_image) }}">
                        @if (file_exists(public_path('storage/communities/' . $post->community->id . '/thumbnail_' . $post->community->logo)))
                            <img class="rounded2" style="width:32px;"
                                src="{{ asset('storage/communities/' . $post->community->id . '/thumbnail_' . $post->community->logo) }}">
                        @else
                            <img src="{{ asset('storage/communities/default.png') }}" class="rounded2"
                                style="width:32px">
                        @endif
                        <span>{{ $post->community->name }}<span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif
