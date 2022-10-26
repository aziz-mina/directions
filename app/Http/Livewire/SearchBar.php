<?php

namespace App\Http\Livewire;

use App\Models\Community;
use App\Models\User;
use App\Models\Post;
use Livewire\Component;

class SearchBar extends Component
{
    public $query;
    public $communities;
    public $users;
    public $posts;


    public function mount()
    {
        $this->query_reset();
    }


    public function query_reset()
    {
        $this->query = '';
        $this->communities = [];
        $this->posts = [];
        $this->users = [];
    }

    public function updatedQuery()
    {
        $this->communities = Community::where('name', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();

        $this->users = User::where('name', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();

        $this->posts = Post::where('title', 'like', '%' . $this->query . '%')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.search-bar');
    }
}
