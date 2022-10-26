<!-- Share Modal -->
@isset($post)
    <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Share Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Share this link via</p>
                    <div class="d-flex align-items-center icons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $post->title }}&amp;src={{ route('communities.posts.show', [$post->slug]) }}"
                            class="fs-5 d-flex align-items-center justify-content-center">
                            <span class="fab fa-facebook-f"></span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?{{ $post->title . ' src : ' . route('communities.posts.show', [$post->slug]) }}"
                            class="fs-5 d-flex align-items-center justify-content-center">
                            <span class="fab fa-twitter"></span>
                        </a>
                        <a href="https://wa.me/text={{ $post->title . ' src : ' . route('communities.posts.show', [$post->slug]) }}"
                            class="fs-5 d-flex align-items-center justify-content-center">
                            <span class="fab fa-whatsapp"></span>
                        </a>
                        <a href="https://t.me/share/url?url={{ route('communities.posts.show', [$post->slug]) }}&text={{ $post->title }}"
                            class="fs-5 d-flex align-items-center justify-content-center">
                            <span class="fab fa-telegram-plane"></span>
                        </a>
                    </div>
                    <p>Or copy link</p>
                    <div class="field d-flex align-items-center justify-content-between">
                        <span class="fas fa-link text-center"></span>
                        <input type="text" id="copy_input" value="{{ route('communities.posts.show', [$post->slug]) }}">
                        <button>Copy</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endisset
