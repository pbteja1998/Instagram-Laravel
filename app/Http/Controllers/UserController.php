<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Relation;
use App\Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $following_users = request()->user()->following;
        $users = $users->diff($following_users);
        return view('users.index', ['users'=>$users,'following_users'=>$following_users]);
    }

    public function isFollowing($id)
    {
        $user = request()->user();
        if (Relation::where('follower_id', $user->id)->where('followee_id', $id)->exists()) {
            return 1;
        }
        return 0;
    }

    public function follow_user(User $user)
    {
        request()->user()->toggleFollower($user);
        return back();
    }

    public function like(Image $image){
        request()->user()->toggleLike($image);
        return back();
    }
}
