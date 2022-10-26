<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Community;
use App\Models\UserCommunity;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* ------------------------ Post Gates---------------------*/

        Gate::define('edit-post', function (User $user, Post $post) {
            return  $post->user_id == $user->id;
        });

        Gate::define('delete-post', function (User $user, Post $post) {
            return  $user->is_admin || in_array($user->id, [$post->user_id, $post->community->user_id]);
        });

        /* ----------------------- Comment Gates--------------------*/

        Gate::define('edit-comment', function (Comment $comment, User $user) {
            return  $comment->user_id == $user->id;
        });

        Gate::define('delete-comment', function ($user, Comment $comment) {
            return  $user->is_admin || $comment->user_id == $user->id;
        });

        /* ----------------------- Community--------------------*/

        Gate::define('manage-community', function (User $user, Community $community) {
            return  $community->user_id == $user->id;
        });

        /* ----------------------- User Gates---------------------*/

        // Gate::define('joined-community', function (User $user, Community $community, $community_id) {

        //     return  $user == auth()->id() || $community_id == $community->id;
        // });

        /* ----------------------- Admin Gates--------------------*/

        // Gate::define('manage_users', function (User $user) {
        //     return $user->is_admin == 1;
        // });
    }
}
