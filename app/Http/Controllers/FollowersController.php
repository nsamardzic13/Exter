<?php

namespace App\Http\Controllers;

use App\Notifications\followed;
use App\User;
use Illuminate\Http\Request;

class FollowersController extends Controller{

    public function follow(){
        $user = auth()->user();

        $data = request()->validate([
            'followerId' => 'required',
        ]);

        $user2 = User::find($data['followerId']);

        if(!$user->isFollowing($user2)) {
            $user->follow($user2);
            $userName = $user->name;
            $user2->notify(new followed($userName));
            return;
        }

    }

    public function unFollow(){
        $user = auth()->user();

        $data = request()->validate([
            'followerId' => 'required',
        ]);

        $user2 = User::find($data['followerId']);

        if($user->isFollowing($user2)) {
            $user->unfollow($user2);
        } else {
            return;
        }

    }

}
