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



        $lat1 =  Geocoder::getCoordinatesForAddress('Janka polića kamova 81a')['lat'];
        $lng1 =  Geocoder::getCoordinatesForAddress('Janka polića kamova 81a')['lng'];

        $lat2 =  Geocoder::getCoordinatesForAddress('Opatija, Nikola tesla 5')['lat'];
        $lng2 =  Geocoder::getCoordinatesForAddress('Opatija, Nikola tesla 5')['lng'];

        // "accuracy" => "result_not_found" U SLUCAJU DA NE POSTOJI MJESTO
        dd(Geocoder::getCoordinatesForAddress('fdsfsd'));

    }

    public function getDistance(float $lat1, float $lng1, float $lat2, float $lng2){
        $r = 6371;
        $dlat = deg2rad($lat2-$lat1);
        $dlng = deg2rad($lng2-$lng1);

        $a = sin($dlat/2) * sin($dlat/2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dlng/2) * sin($dlng/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        $d = $r * $c;

        return $d;
    }
}
