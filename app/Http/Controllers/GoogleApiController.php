<?php

namespace App\Http\Controllers;
use App\Occasion;
use Illuminate\Support\Collection;
use GoogleMaps\GoogleMaps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\BinaryOp\Equal;
use PhpParser\Node\Expr\Cast\Object_;
use Spatie\Geocoder\Facades\Geocoder;

class GoogleApiController extends Controller
{
    public function index(){

        $user = auth()->user();
        $keyss = array_keys($user->sport->getAttributes(), 'true');
        $keysh = array_keys($user->hangout->getAttributes(), 'true');
        $keyst = array_keys($user->availability->getAttributes(), 'true');

        //dd($keyst);
        //dd($keyss);
        $keys = array_merge($keysh, $keyss);
        $lat1 = $user->lat;
        $lng1 = $user->lng;

        $events = DB::table('occasions');
        if(!empty($keys)) {
            $events = $events->whereIn('category', $keys);
        }
        $events = $events->get();

        $count = 0;
        foreach ($events as $event) {
            //false brisi true nastavi
            if(!$this->checkTime($event, $keyst)){
                $events->pull($count);
            } else if ($lat1){
                $event->dist = $this->getDistance($lat1, $lng1, $event->lat, $event->lng);
            }
            $count++;
        }
        //Sortiranje po dist; ali ako ima ili nema dist sortiraj po vremenu starta eventa
        $sortedEvents = $events->sortBy('dist')->sortBy('start');

        dd($sortedEvents);

    }

    public function checkTime(Object $event, Array $keyst) {
        //false brisi true nastavi
        if (empty($keyst)){
            return true;
        }
        $flag = true;
        $start_time = $event->start;
        $start_hours = $event->start;
        $start_hours = date('H:i');

        if($this->isWeekend(date($start_time)) && in_array('weekend', $keyst)){
            $flag = $flag && false;
        }
        if(!$this->isWeekend(date($start_time)) && !in_array('workday', $keyst)){
            $flag = $flag && false;
        }

        if(!in_array($this->timeOfDay($start_hours), $keyst)){
            $flag = $flag && false;
        }
        return $flag;
    }

    public function timeOfDay($start_hours) {
        if($start_hours < 12){
            return 'morning';
        } else if ($start_hours >= 12 && $start_hours < 19){
            return 'afternoon';
        }
        return 'evening';
    }

    public function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
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
