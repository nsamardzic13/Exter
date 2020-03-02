<?php

namespace App\Http\Controllers;

use App\Sport;
use App\User;
use Illuminate\Http\Request;

class QuestionaryController extends Controller
{
    public function index(){
        //$user = factory(\App\User::class)->create();
        //OVO BI SE TREABLO POZVAT U TRENUTKU KAD JE USER NAPRAVLJEN
        /*$user = auth()->user();
        $sport = new Sport();
        $user->sport()->save($sport);*/
        $user = auth()->user();
        $sportcolumns = $user->sport->getTableColumns();
        //$sports->nth(1, 3);
        //dd($sports);
        return view('questionary.index', compact('user', 'sportcolumns'));
    }

    public function store(Request $request){
        $user = auth()->user();
        /*foreach ($request->sports as $sport){
            //dd($user->sport->$sport);
            $user->sport->$sport = 1;
            $user->sport->save();
        }*/
        $sportcolumns = $user->sport->getTableColumns();
        if($request->sports) {
            foreach ($sportcolumns as $sportcolumnKey => $sportcolumn) {
                if ($sportcolumnKey < 2 || $sportcolumnKey > count($sportcolumns) - 3) continue;
                foreach ($request->sports as $sport) {
                    if ($sport == $sportcolumn) {
                        $user->sport->$sport = 1;
                        $user->sport->save();
                        break;
                    }
                    $user->sport[$sportcolumn] = 0;
                    $user->sport->save();
                }
            }
        } else {
            foreach ($sportcolumns as $sportcolumnKey => $sportcolumn) {
                if ($sportcolumnKey < 2 || $sportcolumnKey > count($sportcolumns) - 3) continue;
                $user->sport[$sportcolumn] = 0;
                $user->sport->save();
            }
        }
        return redirect('/questionary');
        //dd(Sport::where('user_id', $user->id)->get());
        //dd($user->sport->basketball);
    }
}
