<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\UserCommunity;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // popular this week

        if (request('sort', '') == '') {
            $posts = Post::with('community')->withCount(['postVotes' => function ($query) {
                $query->where('post_votes.created_at', '>', now()->subDays(7))
                    ->where('vote', 1);
            }])->orderBy('post_votes_count', 'desc')->take(10)->get();
        }

        // hot & latest Posts

        $query = Post::with('community');

        if (request('sort', '') == 'popular') {
            $query->orderBy('votes', 'desc');
        } elseif (request('sort', '') == 'new') {
            $query->latest('id');
        }

        $posts = $query->where('approved', 1)->paginate('10');

        return view('home', compact('posts'));
    }
}
