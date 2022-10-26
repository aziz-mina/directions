<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityPostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(["verify" => true]);

Route::get('community/{slug}', [CommunityController::class, 'show'])
    ->name('communities.show');

Route::get('post/{slug}', [CommunityPostController::class, 'show'])
    ->name('communities.posts.show');

Route::get('user/{userName}', [UserController::class, 'show'])
    ->name('users.show');

Route::get('communities/topics/{topicId}', [CommunityController::class, 'showTopicCommunities'])
    ->name('topics.show');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::resource('communities', CommunityController::class)
        ->except('show');

    Route::resource('communities.posts', CommunityPostController::class)
        ->except('show');

    Route::resource('posts.comments', PostCommentController::class);

    Route::post("join/{id}", [UserController::class, "join"])
        ->name('join');

    Route::post("leave/{id}", [UserController::class, "leave"])
        ->name('leave');

    Route::group(['prefix' => 'mystuff'], function () {

        Route::get("communities", [CommunityController::class, "index"])
            ->name('communities');

        Route::get("posts", [CommunityPostController::class, "myPosts"])
            ->name('posts');

        Route::get("joined_communities", [CommunityController::class, "myCommunities"])
            ->name('communities.joined');

        Route::get("profile", [UserController::class, "edit"])
            ->name('profile.edit');

        Route::post("profile", [UserController::class, "update"])
            ->name('profile.update');

        Route::post("profile/delete", [UserController::class, "destroy"])
            ->name('profile.delete');

        Route::post("communities/{communityUser}/remove", [CommunityController::class, "removeUser"])
            ->name('users.remove');
    });

    Route::post('posts/{postId}/report', [CommunityPostController::class, 'report'])
        ->name('post.report');

    Route::post('user/{userId}/report', [UserController::class, 'report'])
        ->name('user.report');
});

Route::group(['middleware' => ['auth', 'admin']], function () {

    // To Do Admin Panel

});
