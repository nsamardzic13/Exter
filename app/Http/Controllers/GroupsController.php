<?php

namespace App\Http\Controllers;

use App\Group;

use App\Like;
use App\Messages;
use App\Notifications\addedToGroup;
use App\Occasion;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class GroupsController extends Controller{

    public function index(){
        $user = auth()->user();
        //factory(User::class, 10)->create();
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    public function store(){
        $user = auth()->user();

        $data = request()->validate([
            'name' => 'required|min:3|unique:App\Group,name',
            'description' => 'required|max:255'
        ]);

        $group = new Group();
        $group->name = request('name');
        $group->description = request('description');
        $group->admin_id = $user->id;
        $group->save();
        //add user group in pivot table too
        $user->groups()->syncWithoutDetaching([$group->id]);
        return redirect('user/'.$user->id.'#groups')->with('message', 'Group has been added');
    }

    public function show(Group $group, Request $request){
        $user = auth()->user();
        $admin = User::where('id', '=', $group->admin_id)->get();
        $messages = Messages::where('group_id', '=', $group->id)
                            ->orderByDesc('created_at')
                            ->paginate(4);
        $top_users = DB::table('messages')
            ->select('users.id as user_id', 'users.name', DB::raw('count(*) as count'))
            ->join('users', 'messages.user_id','=', 'users.id')
            ->where('messages.group_id', '=', $group->id)
            ->groupBy('users.id');
        $top_users = $top_users->orderBy('count')
                                ->limit(5)
                                ->get();

        $user_events = DB::table('users')
            ->select('users.id as user_id', 'users.name', DB::raw('count(*) as count'), 'group_user.group_id')
            ->join('occasion_user', 'occasion_user.user_id','=', 'users.id')
            ->join('group_user', 'users.id', '=', 'group_user.user_id')
            ->where('group_user.group_id', '=', $group->id)
            ->groupBy('users.id', 'group_user.group_id');
        $user_events = $user_events->orderBy('count')
            ->limit(5)
            ->get();

        /*$likes = DB::table('likes')
                    ->select('message_id', 'users.id as user_id', 'users.name', 'type')
                    ->join('users', 'likes.user_id','=', 'users.id');*/

        $members = $group->users()->orderBy('name')->paginate(5);
        if($request->ajax()) {
            return [
                'messages' => view('messages.index_scroll', compact(['group', 'user', 'messages', 'top_users', 'user_events', 'admin', 'members',]))->render(),
                'next_page' => $messages->nextPageUrl(),
            ];
        }

        return view('groups.show', compact(['group', 'user', 'messages', 'top_users', 'user_events', 'admin', 'members',]));
    }


    public function update(Request $request){
        $ruser = auth()->user();

       $data = request()->validate([
           'userName' => 'required|exists:App\User,name',
           'groupId' =>  'numeric'
       ]);

       //dd($data['groupId']);
        $user = User::where('name', $data['userName'])->first();
        $group = Group::where('id', $data['groupId'])->first();

        $group->users()->syncWithoutDetaching($user->id);
        Session::flash('message', 'You have added '.$user->name.' to group '.$group->name);

        //information needed for notification
        $group_info = $group->name;
        $user->notify(new addedToGroup($group_info));
        //return redirect('user/'.$ruser->id.'#groups')->with('message', 'You have added user to group '.$group->name);
    }

    public function destroy(Group $group){
        $ruser = auth()->user();

        dd($group);
        foreach ($group->users as $user){
            $group->users()->detach($user->id);
        }

        $group->delete();
        return redirect('user/'. $ruser->id.'#groups')->with('message', 'You have deleted group');
    }

    public function edit(Group $group) {

        $data = request()->validate([
            'description' => 'required|max:255',
            'profile_pic' => 'sometimes|file|image|max:4000',
        ]);

        $group->update([
            'description' => $data['description'],
        ]);

        //check if image is submited
        if(request()->has('profile_pic')) {
            $group->update([
                'profile_pic' => request()->profile_pic->store('uploads', 'public'),
            ]);

            //resize photo
            $image = Image::make(public_path('storage/' . $group->profile_pic))->fit(128,128);
            $image->save();
        }

        return redirect('groups/' . $group->id . '#home');
    }

    public function leave_group(Group $group){
            $user = auth()->user();

            $group->users()->detach($user->id);
            return redirect('user/'. $user->id.'#groups')->with('message', 'You have left the group '. $group->name);
    }

    public function removePersonFromGroup() {
        $data = request()->validate([
            'user' => 'required',
            'groupId' => 'required',
        ]);
        $group = Group::where('id', $data['groupId'])->first();
        $group->users()->detach($data['user']);
        return redirect('groups/'. $group->id .'#members')->with('message', 'You have removed person from group');
    }
}


