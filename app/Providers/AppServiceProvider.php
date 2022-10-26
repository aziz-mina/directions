<?php

namespace App\Providers;

use App\Models\Community;
use App\Models\Post;
use App\Models\PostVotes;
use App\Models\Topic;
use App\Observers\PostVotesObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        View::share('trendingCommunities', Community::withCount('posts')->latest()->take(4)->get());
        View::share('trendingPosts', Post::whereNotNull('post_image')->take(10)->where('approved', 1)->get());
        View::share('trendingTopics', Topic::all());
        View::share('newPosts', Post::with('community')->latest()->take(4)->where('approved', 1)->get());

        PostVotes::observe(PostVotesObserver::class);
    }
}
