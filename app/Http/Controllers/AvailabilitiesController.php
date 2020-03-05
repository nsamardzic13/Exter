<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvailabilitiesController extends Controller{

    public function index(){
        $user = auth()->user();
        $availabilitycolumns = $user->availability->getTableColumns();
        return view('questionary.availabilites.aindex', compact('user', 'availabilitycolumns'));
    }

    public function store(Request $request){
        $user = auth()->user();
        $availabilitycolumns = $user->availability->getTableColumns();
        if ($request->avai) {
            foreach ($availabilitycolumns as $avaiColumnKey => $avaiColumn) {
                if ($avaiColumnKey < 2 || $avaiColumnKey > count($availabilitycolumns) - 3) continue;
                foreach ($request->avai as $availability) {
                    if ($availability == $avaiColumn) {
                        $user->availability->$availability = 1;
                        $user->availability->save();
                        break;
                    }
                    $user->availability[$avaiColumn] = 0;
                    $user->availability->save();
                }
            }
        } else {
            foreach ($availabilitycolumns as $avaiColumnKey => $avaiColumn) {
                if ($avaiColumnKey < 2 || $avaiColumnKey > count($availabilitycolumns) - 3) continue;
                $user->availability[$avaiColumn] = 0;
                $user->availability->save();
            }
        }
        return redirect('/questionary')->with('message', 'Your time picks have been changed');
    }
}
