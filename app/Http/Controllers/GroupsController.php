<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Http\Request;

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
            'name' => 'required|min:3|unique:App\Group,name'
        ]);

        $group = new Group();
        $group->name = request('name');
        $group->admin_id = $user->id;
        $group->save();
        //add user group in pivot table too
        $user->groups()->syncWithoutDetaching([$group->id]);

        return redirect('groups');
    }

    public function show(Group $group){

        //dd($group->users());
        return view('groups.show', compact('group'));
    }


    public function update(Group $group){

        $data = request()->validate([
           'name' => 'required|min:3|exists:App\User,name',
       ]);
        $user = User::where('name', request('name'))->first();
        $group->users()->syncWithoutDetaching($user->id);

        return redirect('groups/'. $group->id);
        //return view('groups.show', compact('group'));
    }

}
