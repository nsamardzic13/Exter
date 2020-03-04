<?php

namespace App\Http\Controllers;

use App\Sport;
use App\User;
use Illuminate\Http\Request;

class QuestionaryController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('questionary.index', compact('user'));
    }
}
