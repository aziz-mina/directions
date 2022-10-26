<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PostVotes;
use Illuminate\Support\Facades\Auth;

class PostVote extends Component
{
    public $post;
    public $totalVotes;
    // public $componentRoutes;

    public function mount($post)
    {
        $this->post = $post;
        $this->totalVotes = $post->votes;
    }

    public function render()
    {
        return view('livewire.post-vote');
    }

    public function vote($vote)
    {
        if (Auth::check()) {
            if (!$this->post->postVotes->where('user_id', auth()->id())->count() && in_array($vote, [-1, 1])) {
                PostVotes::create([
                    'post_id' => $this->post->id,
                    'user_id' => auth()->id(),
                    'vote' => $vote
                ]);
                $this->totalVotes += $vote;
            }
        } else {
            redirect()->to('login');
        }
    }
}
