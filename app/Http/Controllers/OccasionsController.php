<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Occasion;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class OccasionsController extends Controller
{
    public function index(){

        $user = auth()->user();
    	
        $occasions = DB::table('occasions')->paginate(12);

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

            $days = ['Monday', 'Tuesday', 'Wendsday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


            return view('occasions.create', compact('category', 'days'));
        }
            return view('occasions.create');

        
    }
   

    public function store(){
        $data = request()->validate([
            'name'=> 'required|min:3',
            'street'=> 'required|min:3',
            'city'=> 'required|min:3',
            'zipcode'=> 'required|min:3',
            'when'=> 'required',            
            'category'=> 'required|min:3',
            'max_people'=> 'required|numeric|min:2',
        ]);
        unset($data['when']);
        if (request('when') == '1'){
            $when = request()->validate([
                'day' => 'required',                
                'start'=> 'required|date|after:today',
                'end'=> 'required|date|after:start',
                'time-start' => 'required',
                'time-end' => 'required|after:time-start',
            ]);
            
            $timezone = date_default_timezone_get();
            date_default_timezone_set($timezone);

            $checkedDays = request('day');
            $user_id = Auth::user()->id;
            

                $stime = request('time-start');
                $etime = request('time-end');

                $startdate = strtotime(request('start'));
                $enddate = strtotime(request('end'));
                //dd($startdate);
                

                //dd($stime);
                
            for ( $i = $startdate; $i <= $enddate; $i = $i + 86400 ) {
                $today = date("N", $i);
                foreach ($checkedDays as $day => $value) {
                    //echo $today . ' '. $value;
                    if($today == $value+1){
                        $sdate = date('Y-m-d', $i). ' '. $stime;
                        $edate = date('Y-m-d', $i). ' '. $etime;
                        //echo $sdate;
                       dd($sdate);
                        $occasion = Occasion::create(array_merge($data, ['start' => $sdate], ['end' => $edate], ['user_id'  =>  $user_id]));

                    }

                }
            }
            
        } else {
            $when = request()->validate([
                'start'=> 'required|date|after:today',
                'end'=> 'required|date|after:start',
            ]);
           
            $user_id = Auth::user()->id;
            
            $occasion = Occasion::create(array_merge($data, $when, ['user_id'  =>  $user_id]));
        }




        return redirect('events');
    }

    public function show(Occasion $occasion){

       
        return view('occasions.show', compact('occasion'));
    }
}
