<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\UserCommunity;
use App\Models\User;
use App\Models\Post;
use App\Notifications\UserReportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userName)
    {
        $user = User::where('username', $userName)->firstOrFail();
        $userId = $user->id;
        $posts = Post::where('user_id', $userId)->get();
        return view('users.profile', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::findOrFail(auth()->id());
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->id());

        if ($request->hasFile('avatar')) {

            $image = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')
                ->storeAs('users/' . $user->id, $image);

            if ($user->avatar != 'default.png' && $user->avatar != $image) {
                unlink(storage_path('app/public/users/' . $user->id . '/' . $user->avatar));
            }

            $user->update(['avatar' => $image]);

            $file = Image::make(storage_path('app/public/users/' . $user->id . '/' . $image));
            $file->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $file->save(storage_path('app/public/users/' . $user->id . '/thumbnail_' . $image));

            flash()->addSuccess('Your Avatar Updated Successfully.');

            return redirect()->back();
        }

        if ($request->only('name', 'email')) {

            $user->update(['name' => $request->name], ['email' => $request->email]);

            flash()->addSuccess('Your Data Updated Successfully.');

            return redirect()->back();
        }

        if ($request->old_password && $request->new_password) {

            $request->validate([
                'new_password' => 'required|string|min:8|alpha_num',
                'password_confirmation' => 'required|string|min:8|alpha_num',
            ]);

            if (Hash::check($request->old_password, $user->password)) {
                if ($request->new_password == $request->password_confirmation) {
                    $user->update(['password' => Hash::make($request->new_password)]);
                    flash()->addSuccess('Your Password Updated Successfully.');
                    return redirect(url()->previous() . '#password');
                } else {
                    flash()->addError('Your Password dont match confirm.');
                    return redirect(url()->previous() . '#password');
                }
            } else {
                flash()->addError('Your Old password is wrong.');
                return redirect(url()->previous() . '#password');
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $user = User::findOrFail(auth()->id());
        $user->delete();
        return redirect()->route('login');
    }

    public function join($communityId)
    {
        UserCommunity::create(['user_id' => auth()->id(), 'community_id' => $communityId]);
        flash()->addSuccess('You Joined Successfully.');
        return redirect()->back();
    }

    public function leave($communityId)
    {
        $user_community = UserCommunity::where(
            'user_id',
            auth()->id()
        )->where('community_id', $communityId);
        $user_community->delete();

        flash()->addSuccess('You Leaved Successfully.');
        return redirect()->back();
    }

    public function report($userId)
    {
        $user = User::findOrFail($userId);
        $user->notify(new UserReportNotification($user));

        flash()->addSuccess('You Report send Successfully');
        return redirect()->back();
    }
}
