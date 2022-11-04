<?php

use App\Models\Community;
use App\Models\Topic;
use App\Models\Post;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

Breadcrumbs::for('topic', function (BreadcrumbTrail $trail,  Topic $topic) {
    $trail->push($topic->name . ' Communities', route('topics.show', $topic->id));
});

Breadcrumbs::for('communities', function (BreadcrumbTrail $trail): void {
    $trail->push('Manage Communities');
});

Breadcrumbs::for('createCommunity', function (BreadcrumbTrail $trail) {
    $trail->push('Create Community');
});

Breadcrumbs::for('editCommunity', function (BreadcrumbTrail $trail, Community $community): void {
    $trail->push($community->name . ' Community', route('communities.show', $community->slug));
    $trail->push('Edit Community');
});

Breadcrumbs::for('myCommunities', function (BreadcrumbTrail $trail): void {
    $trail->push('Joined Communities');
});

Breadcrumbs::for('createPost', function (BreadcrumbTrail $trail, Community $community): void {
    $trail->push($community->name . ' Community', route('communities.show', $community->slug));
    $trail->push('Create Post');
});

Breadcrumbs::for('editPost', function (BreadcrumbTrail $trail, Community $community): void {
    $trail->push($community->name . ' Community', route('communities.show', $community->slug));
    $trail->push('Edit Your Post');
});

Breadcrumbs::for('myPosts', function (BreadcrumbTrail $trail): void {
    $trail->push('Manage My Posts');
});

Breadcrumbs::for('savedPosts', function (BreadcrumbTrail $trail): void {
    $trail->push('My Saved Posts');
});

Breadcrumbs::for('showPost', function (BreadcrumbTrail $trail, Post $post): void {
    $trail->push($post->community->name . ' Community', route('communities.posts.show', $post->slug));
    $trail->push(auth()->id() == $post->user_id ? 'Your post' : $post->user->name . '\'s post');
});

Breadcrumbs::for('editProfile', function (BreadcrumbTrail $trail): void {
    $trail->push('Update My Profile');
});