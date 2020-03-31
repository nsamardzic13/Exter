<?php

namespace App\Http\Controllers;

use App\Group;
use App\Like;
use App\Messages;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        //$user = auth()->user();
        //dd($group->users());
        //dd($user->groups->name);
        $user = auth()->user();
        $messages = Messages::where('group_id', '=', $group->id)
                            ->orderByDesc('created_at')
                            ->paginate(4);
        $likes = DB::table('likes')
                    ->select('users.name')
                    ->join('messages', 'likes.message_id', '=', 'messages.id')
                    ->join('users', 'likes.user_id','=', 'users.id')
                    ->where('messages.group_id', '=', $group->id)->get();
//        dd($likes);
        if($request->ajax()) {

            return [
                'messages' => view('messages.index_scroll', compact(['group', 'user', 'messages', 'likes']))->render(),
                'next_page' => $messages->nextPageUrl()
            ];
        }

        return view('groups.show', compact(['group', 'user', 'messages', 'likes']));
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
        //return redirect('user/'.$ruser->id.'#groups')->with('message', 'You have added user to group '.$group->name);
    }

    public function destroy(Group $group){
        $ruser = auth()->user();

        foreach ($group->users as $user){
            $group->users()->detach($user->id);
        }

        $group->delete();
        return redirect('user/'. $ruser->id.'#groups')->with('message', 'You have deleted group');
    }
}
