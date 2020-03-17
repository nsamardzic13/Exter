<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller{

    public function fetch_names(Request $request){

        if($request->get('query')){
            $query = $request->get('query');
            $data = DB::table('users')
                ->where('name', 'ILIKE', '%' . $query . '%')->orderBy('name', 'ASC')
                ->get();

            $output = '<div class="dropdown-menu" aria-labelledby="dropdownMenu" style="display:block; position:relative">';
            foreach ($data as $row){
                $output .=  '<a class="dropdown-item" href="#">' .$row->name. '</a>';
            }
            $output .= '</div>';
            echo $output;
        }
    }
}
