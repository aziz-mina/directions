<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Models\Comment;
use App\Models\PostVotes;
use App\Models\SavedPost;
use App\Models\UserCommunity;
use App\Notifications\PostReportNotification;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class CommunityPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Community $community)
    {
        $posts = $community->posts()->latest('id')->paginate(7);
    }

    public function myPosts()
    {
        $myPosts = Post::where('user_id', auth()->id())->get();
        return view('posts.index', compact('myPosts'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Community $community)
    {
        if ((UserCommunity::where('user_id', auth()->id())->where('community_id', $community->id))->exists()) {
            return view('posts.create', compact('community'));
        } else {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request, Community $community)
    {
        //admin of community
        if ($community->user_id == auth()->id()) {
            $post = $community->posts()->create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'post_text' => $request->post_text ?? null,
                'post_url' => $request->post_url ?? null,
                'approved' => 1
            ]);
        } else {
            $post = $community->posts()->create([
                'user_id' => auth()->id(),
                'title' => $request->title,
                'post_text' => $request->post_text ?? null,
                'post_url' => $request->post_url ?? null,
            ]);
        }
        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')
                ->storeAs('posts/' . $post->id, $image);
            $post->update(['post_image' => $image]);

            $file = Image::make(storage_path('app/public/posts/' . $post->id . '/' . $image));
            $file->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/posts/' . $post->id . '/thumbnail_' . $image));
        }

        flash()->addSuccess(' Post Added Successfully.');

        return redirect()->route('communities.show', $community);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($slug)
    {
        $post = Post::with('comments.user', 'community')->where('slug', $slug)->firstOrFail();
        $isJoinedCommunity = UserCommunity::where('user_id', auth()->id())
            ->where('community_id', $post->community_id)
            ->count() == 1  ? true : false;

        return view('posts.show', compact('post', 'isJoinedCommunity'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community, Post $post)
    {
        if (Gate::denies('edit-post', $post)) {
            abort(403);
        }
        return view('posts.edit', compact('community', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Community $community, Post $post)
    {
        if (Gate::denies('edit-post', $post)) {
            abort(403);
        }

        $post->update($request->validated());

        if ($request->hasFile('post_image')) {
            $image = $request->file('post_image')->getClientOriginalName();
            $request->file('post_image')
                ->storeAs('posts/' . $post->id, $image);

            if ($post->post_image != '' && $post->post_image != $image) {
                unlink(storage_path('app/public/posts/' . $post->id . '/' . $post->post_image));
            }

            $post->update(['post_image' => $image]);

            $file = Image::make(storage_path('app/public/posts/' . $post->id . '/' . $image));
            $file->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/posts/' . $post->id . '/thumbnail_' . $image));
        }

        flash()->addSuccess('Your Post Updated Successfully.');

        return redirect()->route('communities.posts.show', [$community, $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community, Post $post)
    {
        if (Gate::denies('delete-post', $post)) {
            abort(403);
        }

        $post->delete();

        flash()->addSuccess(' Post Deleted Successfully.');

        return redirect()->route('communities.show', [$community]);
    }


    public function vote($post_id, $vote)
    {
        $post = Post::with('community')->findOrFail($post_id);

        if (
            !PostVotes::where('post_id', $post_id)
                ->where('user_id', auth()->id())->count()
            && in_array($vote, [-1, 1]) &&
            $post->user_id != auth()->id()
        ) {
            PostVotes::create([
                'post_id' => $post_id,
                'user_id' => auth()->id(),
                'vote' => $vote
            ]);
        }

        return redirect()->route('communities.show', $post->community);
    }

    public function report($post_id)
    {
        $post = Post::with('community.user')->findOrFail($post_id);
        $post->community->user->notify(new PostReportNotification($post));

        flash()->addSuccess('You Report send Successfully');
        return redirect()->back();
    }

    public function approve($communityId)
    {

        $community = Community::findOrfail($communityId);

        if ($community->user_id != auth()->id()) {
            abort(403);
        }

        Post::where('community_id', $community->id)->update(['approved' => 1]);
        flash()->addSuccess('Report Approved Successfully');
        return redirect()->back();
    }

    public function save($postId)
    {
        SavedPost::create([
            'user_id' => auth()->id(),
            'post_id' => $postId
        ]);

        flash()->addSuccess('Post Saved Successfully');
        return redirect()->back();
    }

    public function unsave($postId)
    {
        $saved_post = SavedPost::where('user_id',auth()->id())->where('post_id',$postId)->delete();
        flash()->addSuccess('Post UnSaved Successfully');
        return redirect()->back();
    }
}
