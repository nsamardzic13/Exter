<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Occasion;

use Illuminate\Support\Facades\Auth;


class OccasionsController extends Controller
{
    public function index(){

        $user = auth()->user();
    	
        $occasions = Occasion::all();
        return view('occasions.index', compact('user', 'occasions'));
    }

    public function create(){
        
        $user = auth()->user();
        if($user){
            $hangouts = $user->hangout->getTableColumns();
            $sports = $user->sport->getTableColumns();
            $categories = array_merge($hangouts, $sports);
            
            $exclude = array("user_id", "id", "updated_at", "created_at");
            
            $category = array_diff($categories, $exclude);

            return view('occasions.create', compact('category'));
        }
            return view('occasions.create');

        
    }
   

    public function store(){
    	$data = request()->validate([
    		'name'=> 'required|min:3',
    		'street'=> 'required|min:3',
            'city'=> 'required|min:3',
            'zipcode'=> 'required|min:3',
            'start'=> 'required|date|after:today',
            'end'=> 'required|date|after:start',
            'category'=> 'required|min:3',
            'max_people'=> 'required|numeric|min:2',
    	]);


    	$user_id = Auth::user()->id;
    	
        $occasion = Occasion::create(array_merge($data, ['user_id'  =>  $user_id]));

    	return redirect('events');
    }

    public function show(Occasion $occasion){

       
        return view('occasions.show', compact('occasion'));
    }
}
