<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HangoutsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $hangoutcolumns = $user->hangout->getTableColumns();
        return view('questionary.hangouts.hindex', compact('user', 'hangoutcolumns'));
    }

    public function store(Request $request){
        $user = auth()->user();
        $hangoutcolumns = $user->hangout->getTableColumns();
        if ($request->hangouts) {
            foreach ($hangoutcolumns as $hangoutColumnKey => $hangoutColumn) {
                if ($hangoutColumnKey < 2 || $hangoutColumnKey > count($hangoutcolumns) - 3) continue;
                foreach ($request->hangouts as $hangout) {
                    if ($hangout == $hangoutColumn) {
                        $user->hangout->$hangout = 1;
                        $user->hangout->save();
                        break;
                    }
                    $user->hangout[$hangoutColumn] = 0;
                    $user->hangout->save();
                }
            }
        } else {
            foreach ($hangoutcolumns as $hangoutColumnKey => $hangoutColumn) {
                if ($hangoutColumnKey < 2 || $hangoutColumnKey > count($hangoutcolumns) - 3) continue;
                $$user->hangout[$hangoutColumn] = 0;
                $user->hangout->save();
            }
        }
        return redirect('/questionary')->with('message', 'Your activity picks have been changed');
    }
}
