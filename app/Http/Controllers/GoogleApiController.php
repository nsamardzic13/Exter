<?php

namespace App\Http\Controllers;

use GoogleMaps\GoogleMaps;
use Illuminate\Http\Request;
use Spatie\Geocoder\Facades\Geocoder;

class GoogleApiController extends Controller
{
    public function index(){
        /*$response = \GoogleMaps::load('geocoding')
            ->setParam (['address' =>'santa cruz'])
            ->get();
        return $response;*/

        $geocode =  Geocoder::getCoordinatesForAddress('Minakovo 28 Pehlin, Rijeka');
        dd($geocode);
        //return Geocoder::getCoordinatesForAddress('Minakovo 28 Pehlin, Rijeka');;
    }
}
