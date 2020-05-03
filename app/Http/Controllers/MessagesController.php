<?php

namespace App\Http\Controllers;

use App\Like;
use App\Messages;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $messages = Messages::all();
        return view('messages.index', compact(['user', 'messages']));
//        return view('messages.index', compact(['user']));
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
//        dd(request()->all());
        $messages = new Messages();
        $data = request()->validate([
            'comment' => 'required',
            'user_id' => 'required',
            'group_id' => 'required',
            'type' => 'required',
        ]);
//        dd($data);

        $messages->user_id = $data['user_id'];
        if ($data['type'] == 'group') {
            $messages->group_id = $data['group_id'];
        }
        else {
            $messages->event_id = $data['group_id'];
        }
        $messages->message_flag = false;
        $messages->message_text = $data['comment'];
//        dd($messages);

        $messages->save();

        if ($data['type'] == 'group') {
            return redirect('/groups/' . $data['group_id'] . '#wall');
        }
        return redirect('/events/' . $data['group_id'] . '#wall');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function edit(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $messages)
    {

        $data = request()->validate([
            'message_id' => 'required',
            'like_dislike' => 'required',
            'group_id' => 'required',
            'type' => 'required',
        ]);
        $user = Auth::user();
        switch ($data['like_dislike']) {
            case 'like':
                if ($this->checkIfExists($user->id, $data['message_id'])) {
                    Messages::where('id', $data['message_id'])->decrement('dislikes', 1);
                    $this->removeFromLikes($user->id, $data['message_id']);
                }
                Messages::where('id', $data['message_id'])->increment('likes', 1);
                DB::table('likes')->insert([
                   'user_id' => $user->id,
                   'message_id' => $data['message_id'],
                   'type' => true,
                ]);
                break;
            case 'dislike':
                if ($this->checkIfExists($user->id, $data['message_id'])) {
                    Messages::where('id', $data['message_id'])->decrement('likes', 1);
                    $this->removeFromLikes($user->id, $data['message_id']);
                }
                Messages::where('id', $data['message_id'])->increment('dislikes', 1);
                DB::table('likes')->insert([
                    'user_id' => $user->id,
                    'message_id' => $data['message_id'],
                    'type' => false,
                ]);
                break;
        }

        if (strtolower($data['type']) == 'groups') {
            return redirect('groups/' . $data['group_id']);
        }
        return redirect('events/' . $data['group_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }

    public static function checkIfExists($user, $msg) {
        return Like::where('user_id', '=', $user)
            ->where('message_id', '=', $msg)
            ->first();
    }

    public static function removeFromLikes($user, $msg) {
        return Like::where('user_id', '=', $user)
            ->where('message_id', '=', $msg)
            ->delete();
    }

    public function showLikes(Request $request) {
        if($request->ajax()) {

            $likes = (\Illuminate\Support\Facades\DB::table('likes')
                         ->select('message_id', 'users.id as user_id', 'users.name', 'type')
                         ->join('users', 'likes.user_id','=', 'users.id')
                         ->where('message_id', '=', $request->id)
                         ->where('type', '=', $request->value)
                         ->paginate(10000));
            return [
                'likes' => $likes,
            ];
        }
    }

}
