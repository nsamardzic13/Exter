<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller{

    public function update(Request $request){
        $user = auth()->user();

        $data = request()->validate([
            'notifyId' => 'required',
        ]);

        foreach ($user->unreadNotifications as $notify){
            if($notify['id'] == $data['notifyId']){
                $notify->markAsRead();
                break;
            }
        }
    }

    public function checkAll(Request $request){
        $user = auth()->user();

        foreach ($user->unreadNotifications as $notify){
                $notify->markAsRead();
        }
    }
}
