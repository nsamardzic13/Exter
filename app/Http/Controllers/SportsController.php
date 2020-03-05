<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SportsController extends Controller{
    public function index(){
        $user = auth()->user();
        $sportcolumns = $user->sport->getTableColumns();
        return view('questionary.sports.sindex', compact('user', 'sportcolumns'));
    }

    public function store(Request $request){
        $user = auth()->user();
        //THIS CODE IS IN CASE WE DONT WONT USER TO EDIT HIS CHOICES AFTER HIS FINISHED
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
        return redirect('/questionary')->with('message', 'Your sport picks have been changed');
    }
}
