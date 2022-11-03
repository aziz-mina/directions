<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Topic;
use App\Models\Community;
use App\Models\Post;
use App\Models\UserCommunity;
use App\Http\Requests\StoreCommunityRequest;
use App\Http\Requests\UpdateCommunityRequest;
use App\Models\CommunityTopic;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use League\ColorExtractor\Color;
use League\ColorExtractor\ColorExtractor;
use League\ColorExtractor\Palette;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Community::where('user_id', auth()->id())->get();
        return view('communities.index', compact('communities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        return view('communities.create', compact('topics'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommunityRequest $request)
    {
        $community = Community::create($request->validated() + [
            'user_id' => auth()->id()
        ]);
        $community->topics()->attach($request->topics);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo')->getClientOriginalName();
            $request->file('logo')
                ->storeAs('communities/' . $community->id, $image);

            $community->update(['logo' => $image]);

            $file = Image::make(storage_path('app/public/communities/' . $community->id . '/' . $image));
            $file->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/communities/' . $community->id . '/thumbnail_' . $image));

            $palette = Palette::fromFilename(storage_path('app/public/communities/' . $community->id . '/thumbnail_' . $image));

            $extractor = new ColorExtractor($palette);
            $colors = $extractor->extract(4);
            $color_palette = array();

            foreach ($colors as $value) {
                $color_palette[] = Color::fromIntToHex($value);
            }

            $community->update(['color_palette' => $color_palette]);
        }

        // First user to join community

        UserCommunity::create(['user_id' => auth()->id(), 'community_id' => $community->id]);

        flash()->addSuccess('Your Community Created Successfully.');

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
        $community = Community::where('slug', $slug)->firstOrFail();
        //$color_pallete =  json_decode($community->color_palette, true);

        $isJoinedCommunity = UserCommunity::where('user_id', auth()->id())
            ->where('community_id', $community->id)
            ->count() == 1 ? true : false;

        $query = $community->posts()->with('postVotes');

        if (request('sort', '') == 'popular') {
            $query->orderBy('votes', 'desc');
        } else {
            $query->latest('id');
        }

        $posts = $query->latest('id')->where('approved', 1)->paginate('10');
        return view('communities.show', compact('community', 'posts', 'isJoinedCommunity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Community $community)
    {
        if ($community->user_id != auth()->id()) {
            abort(403);
        }

        $communityUsers = UserCommunity::where('community_id', $community->id)
            ->where('user_id', '!=', auth()->id())
            ->get();

        $community = Community::where('id', $community->id)
            ->firstOrFail();
        $postRequests = Post::where('community_id', $community->id)
            ->where('approved', 0)
            ->get();

        $topics = Topic::all();
        $community->load('topics');
        return view('communities.edit', compact('community', 'topics', 'communityUsers', 'postRequests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommunityRequest $request, Community $community)
    {
        if ($community->user_id != auth()->id()) {
            abort(403);
        }

        $community->update($request->validated());
        $community->topics()->sync($request->topics);

        if ($request->hasFile('logo')) {
            $image = $request->file('logo')->getClientOriginalName();
            $request->file('logo')
                ->storeAs('communities/' . $community->id, $image);

            if ($community->logo != 'default.png' && $community->logo != $image) {
                unlink(storage_path('app/public/communities/' . $community->id . '/' . $community->logo));
            }

            $community->update(['logo' => $image]);

            $file = Image::make(storage_path('app/public/communities/' . $community->id . '/' . $image));
            $file->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $file->save(storage_path('app/public/communities/' . $community->id . '/thumbnail_' . $image));

            $palette = Palette::fromFilename(storage_path('app/public/communities/' . $community->id . '/thumbnail_' . $image));

            $extractor = new ColorExtractor($palette);
            $colors = $extractor->extract(4);
            $color_palette = array();

            foreach ($colors as $value) {
                $color_palette[] = Color::fromIntToHex($value);
            }

            $community->update(['color_palette' => $color_palette]);
        }

        flash()->addSuccess('Your Community Updated Successfully.');

        return redirect()->route('communities.index')->with('message', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Community $community)
    {
        if ($community->user_id != auth()->id()) {
            abort(403);
        }

        $community->delete();

        flash()->addSuccess('Your Community Deleted Successfully.');

        return redirect()->route('communities.index');
    }

    public function myCommunities()
    {
        $myCommunities = UserCommunity::where('user_id', auth()->id())->get();
        return view('communities.my', compact('myCommunities'));
    }

    public function showTopicCommunities($topicId)
    {
        $topic = Topic::where('id', $topicId)->first();
        $communities = DB::table('community_topic')
            ->join('communities', 'community_topic.community_id', '=', 'communities.id')
            ->where('community_topic.topic_id', '=', $topicId)
            ->get();

        return view('communities.topic', compact('communities', 'topic'));
    }

    public function removeUser($communityUser)
    {
        $user_community = UserCommunity::where(
            ['user_id', $communityUser->user->name],
            ['community_id', $communityUser->id]
        );

        $user_community->delete();

        flash()->addSuccess('User removed Successfully.');
        return redirect()->back();
    }
}
