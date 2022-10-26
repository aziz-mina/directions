<?php

namespace App\Observers;

use App\Models\PostVotes;

class PostVotesObserver
{
    /**
     * Handle the PostVotes "created" event.
     *
     * @param  \App\Models\PostVotes  $postVotes
     * @return void
     */
    public function created(PostVotes $postVotes)
    {
        $postVotes->post->increment('votes', $postVotes->vote);
    }
}
