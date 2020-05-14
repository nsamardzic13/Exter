<?php

namespace App\Http\Controllers;

use App\Messages;
use App\Sport;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

use \App\Occasion;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use mysql_xdevapi\Table;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Integer;
use Spatie\Geocoder\Facades\Geocoder;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;


class OccasionsController extends Controller
{
    public function index(Request $request)
    {
        $this->eventFinished();
        $user = auth()->user();
        $range = 50;
        if ($request->sports || $request->hangouts || $request->availabilities || $request->range && $request->cancelFilters == 'false') {
            if ($request->sports) {
                foreach ($request->sports as $sport) {
                    $user->sport[$sport] = true;
                }
            }
            if ($request->hangouts) {
                foreach ($request->hangouts as $hangout) {
                    $user->hangout[$hangout] = true;
                }
            }
            if ($request->availabilities) {
                foreach ($request->availabilities as $availability) {
                    $user->availability[$availability] = true;
                }
            }
            if ($request->range && $request->range != 50) {
                $range = $request->range;
            }
        }

            if($request->cancelFilters == 'true'){
                $range = 50;
                $user = User::where('id', '=', $user->id)->first();
            }

        $keyss = array_keys($user->sport->getAttributes(), 'true');
        $keysh = array_keys($user->hangout->getAttributes(), 'true');
        $keyst = array_keys($user->availability->getAttributes(), 'true');

        //dd($keyss);
        $keys = array_merge($keysh, $keyss);
        $lat1 = $user->lat;
        $lng1 = $user->lng;

        //I NEED TO GIVE INDEX PAGE CATEGORIES FROM QUESTIONARY FOR FILTRATION
        $sportColumnsAll = $user->sport->getTableColumns();
        $hangoutsColumnsAll = $user->hangout->getTableColumns();
        $availabilityColumnsAll = $user->availability->getTableColumns();

        //removing unnecessary parts from db
        $sportcolumns = array_slice($sportColumnsAll, 2, 12);
        $hangoutscolumns = array_slice($hangoutsColumnsAll, 2, 8);
        $availabilitycolumns = array_slice($availabilityColumnsAll, 2, 5);

       // $events = DB::table('occasions')->where('ended', '=', false);
        $events = DB::table('occasions')->select(DB::raw('min(id) as id, name, street, lat, lng, min(start) as start, user_name, max_people, description, category, picture'))
            ->where('ended', 'false')
            ->groupBy('name', 'street', 'user_name', 'lat', 'lng', 'max_people', 'description', 'category', 'picture');

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

        if($lat1) {
            $occasions = $events->where('dist', '<=', $range)->sortBy('dist');
        }else{
            $occasions = $events->sortBy('start');
        }
        //dd($occasions);

        return view('occasions.index', compact('user', 'occasions', 'sportcolumns', 'hangoutscolumns', 'availabilitycolumns', 'range'));
    }

    public function create()
    {

        $user = auth()->user();
        if ($user) {
            $hangouts = $user->hangout->getTableColumns();
            $sports = $user->sport->getTableColumns();
            $categories = array_merge($hangouts, $sports);

            $exclude = array("user_id", "id", "updated_at", "created_at");

            $category = array_diff($categories, $exclude);

            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


            return view('occasions.create', compact('category', 'days'));
        }
        return view('occasions.create');


    }


    public function store()
    {

        $user = auth()->user();

        //multiple days and times
        //1 for repetitive events
        if (request('when') == '1') {
            $data = request()->validate([
                'name' => 'required|min:3',
                'street' => 'required|min:3',
                'when' => 'required',
                'max_people' => 'required|numeric|min:2',
                'description' => 'required|min:10|max:255',
                'category' => 'required|min:3',
                'picture' => 'sometimes|file|image|max:4000',

            ]);
            unset($data['when']);
            $ntime = request('number-times');

            for ($i = 1; $i <= $ntime; $i = $i + 1) {
                $when = request()->validate([
                    'repeat' => 'required',
                    'start' => 'required|date|after:today',
                    'time-start' . $i => 'required|date_format:H:i',
                    'time-end' . $i => 'required|date_format:H:i',
                    'day' . $i => 'required|array|between:1,7',
                ]);

            }

            $startdate = strtotime(request('start'));
            $enddate = $startdate + (request('repeat') * 86400);

            $streetInDatabase = DB::table('occasions')
                ->select('street', 'lat', 'lng')
                ->where('street', '=', $data['street'])->first();
            //dd(($data['street']), ($streetInDatabase->street));

            if ($streetInDatabase) {
                if ($data['street'] == $streetInDatabase->street) {
                    $lat = $streetInDatabase->lat;
                    $lng = $streetInDatabase->lng;
                } else {
                    $lat = Geocoder::getCoordinatesForAddress($data['street'])['lat'];
                    $lng = Geocoder::getCoordinatesForAddress($data['street'])['lng'];
                }
            } else {
                $lat = Geocoder::getCoordinatesForAddress($data['street'])['lat'];
                $lng = Geocoder::getCoordinatesForAddress($data['street'])['lng'];
            }

            for ($i = 1; $i <= $ntime; $i = $i + 1) {
                $flag = 0;
                $checkedDays = request('day' . $i);

                $stime = request('time-start' . $i);
                $etime = request('time-end' . $i);
                if ($stime > $etime){
                    $flag = 1;
                }

               // dd($checkedDays);
                for ($d = $startdate; $d <= $enddate; $d = $d + 86400) {
                    $today = date("N", $d);

                    foreach ($checkedDays as $day => $value) {
                        if ($today == $value + 1) {
                            $sdate = date('Y-m-d', $d) . ' ' . $stime;
                            if ($flag) {
                                $edate = date('Y-m-d', $d + 86400) . ' ' . $etime;
                            } else {
                                $edate = date('Y-m-d', $d) . ' ' . $etime;
                            }

                            $sdate = Carbon::createFromFormat('Y-m-d H:i', $sdate);
                            $edate = Carbon::createFromFormat('Y-m-d H:i', $edate);

                            $occasion = Occasion::create(array_merge($data, ['start' => $sdate], ['end' => $edate], ['user_name' => $user->name], ['lat' => $lat], ['lng' => $lng]));
                            if(request()->has('picture')) {
                                $occasion->update([
                                    'picture' => request()->picture->store('occassion_uploads', 'public'),
                                ]);

                                //resize photo
                                $image = Image::make(public_path('storage/' . $occasion->picture))->fit(286,180);
                                $image->save();

                            }


                        }

                    }
                }

            }

            ///za jedan dogadaj
        } else {
            $data = request()->validate([
                'name' => 'required|min:3',
                'street' => 'required|min:3',
                'when' => 'required',
                'max_people' => 'required|numeric',
                'description' => 'required|min:10|max:255',
                'category' => 'required|min:3',
                'start-one' => 'required|date|after:today',
                'end-one' => 'required|date|after_or_equal:start-one',
                'time-start-one' => 'required|date_format:H:i',
                'time-end-one' => 'required|date_format:H:i',
                'picture' => 'sometimes|file|image|max:4000',
            ]);
            if (\request('start-one') == \request('end-one')){
                $when = \request()->validate([
                    'time-end-one' => 'after:time-start-one',
                ]);
            };
            unset($data['when'], $data['start-one'], $data['end-one'], $data['time-start-one'], $data['time-end-one']);
            //dd($data['max_people']);
            //dd($data);

            $startdate = request('start-one') . ' ' . request('time-start-one');
            $startdate = Carbon::createFromFormat('Y-m-d H:i', $startdate);

            $streetInDatabase = DB::table('occasions')
                ->select('street', 'lat', 'lng')
                ->where('street', '=', $data['street'])->first();
            //dd(($data['street']), ($streetInDatabase->street));

            if ($streetInDatabase) {
                if ($data['street'] == $streetInDatabase->street) {
                    $lat = $streetInDatabase->lat;
                    $lng = $streetInDatabase->lng;
                } else {
                    $lat = Geocoder::getCoordinatesForAddress($data['street'])['lat'];
                    $lng = Geocoder::getCoordinatesForAddress($data['street'])['lng'];
                }
            } else {
                $lat = Geocoder::getCoordinatesForAddress($data['street'])['lat'];
                $lng = Geocoder::getCoordinatesForAddress($data['street'])['lng'];
            }



            $enddate = request('end-one') . ' ' . request('time-end-one');;
            $enddate = Carbon::createFromFormat('Y-m-d H:i', $enddate);

            $occasion = Occasion::create(array_merge($data, ['start' => $startdate], ['end' => $enddate], ['user_name' => $user->name], ['lat' => $lat], ['lng' => $lng]));

            if(request()->has('picture')) {
                $occasion->update([
                    'picture' => request()->picture->store('occassion_uploads', 'public'),
                ]);

                //resize photo
                $image = Image::make(public_path('storage/' . $occasion->picture))->fit(286,180);
                $image->save();

            }


        }


        return redirect('events')->with('message', 'You have succesfuly created event');
    }


    public function destroy(Occasion $occasion){
        $ruser = auth()->user();

        $alltimes =  \App\Occasion::where('name', $occasion->name)->where('street', $occasion->street)
            ->where('max_people', $occasion->max_people)->where('user_name', $occasion->user_name)
            ->where('description', $occasion->description)->where('category', $occasion->category)
            ->where('picture', $occasion->picture)->get();

        foreach ($alltimes as $event){
            foreach ($event->users as $user){
                $event->users()->detach($user->id);
            }

            $event->delete();
        }

        return redirect('user/'. $ruser->id.'#events')->with('message', 'You have deleted event');
    }

    public static function showTimesForModal($occasion)
    {
        //dd($occasion);
        $time =  DB::table('occasions')->where('name', $occasion->name)->where('street', $occasion->street)
            ->where('max_people', $occasion->max_people)->where('user_name', $occasion->user_name)
            ->where('description', $occasion->description)->where('category', $occasion->category)
            ->where('picture', $occasion->picture)->where('ended', false)->orderBy('start')->get();
        //dd($time);
        return $time;
    }

    public static function showPeopleForModal($occasion)
    {
        $people = DB::table('occasion_user')->where('occasion_id', $occasion->id)->get();

        return $people->count();
    }

    public function show(Occasion $occasion, Request $request)
    {
        $user = auth()->user();
        $admin = User::where('name', '=', $occasion->user_name)->get();
        $flag = false;
        if(!empty($request->input())) {
//            $otherusers = array_values($request->input())[0];
            $otherusers = array(array_values($request->input())[0]);
            foreach ($otherusers as $otheruser) {
                if($otheruser == $user->id) $flag = true;
                $occasion->users()->syncWithoutDetaching($otheruser);
            }
        } else {
            $occasion->users()->syncWithoutDetaching($user->id);
            $flag = true;
        }
        $joined = $occasion->users;
        if(!$flag) return redirect()->action(
            'OccasionsController@index'
        )->with('message', 'You have succesfuly added users to event '. $occasion->name);
        $messages = Messages::where('event_id', '=', $occasion->id)
            ->orderByDesc('created_at')
            ->paginate(4);
        $top_users = DB::table('messages')
            ->select('users.id as user_id', 'users.name', DB::raw('count(*) as count'))
            ->join('users', 'messages.user_id','=', 'users.id')
            ->where('messages.event_id', '=', $occasion->id)
            ->groupBy('users.id');
        $top_users = $top_users->orderBy('count')
            ->limit(5)
            ->get();

        $user_events = DB::table('occasion_user')
            ->select('users.id as user_id', 'users.name', DB::raw('count(*) as count'))
            ->where('occasion_user.occasion_id', '=', $occasion->id)
            ->join('users', 'occasion_user.user_id','=', 'users.id')
            ->groupBy('users.id');
        $user_events = $user_events->orderBy('count')
            ->limit(5)
            ->get();

        /*$likes = DB::table('likes')
                    ->select('message_id', 'users.id as user_id', 'users.name', 'type')
                    ->join('users', 'likes.user_id','=', 'users.id');*/

        if($request->ajax()) {
            return [
                'messages' => view('messages.index_scroll', compact(['occasion', 'user', 'messages', 'top_users', 'user_events', 'admin', ]))->render(),
                'next_page' => $messages->nextPageUrl(),
            ];
        }

        return view('occasions.wall', compact(['occasion', 'user', 'messages', 'top_users', 'user_events', 'admin', ]));
    }
    public function join_group(Occasion $occasion){
        $user = auth()->user();
        $people=  $occasion->max_people - occasionsController::showPeopleForModal($occasion);
        $joined = $occasion->users->pluck('id')->toArray();
        return view('occasions.join_group',  compact(['user', 'occasion', 'people', 'joined']));
    }

    public function recreate(Occasion $occasion)
    {

        $user = auth()->user();
        if ($user) {
            $hangouts = $user->hangout->getTableColumns();
            $sports = $user->sport->getTableColumns();
            $categories = array_merge($hangouts, $sports);

            $exclude = array("user_id", "id", "updated_at", "created_at");

            $category = array_diff($categories, $exclude);

            $days = ['Monday', 'Tuesday', 'Wendsday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

            $event = DB::table('occasions')->where('id', $occasion->id)->first();

            return view('occasions.create', compact('category', 'days', 'event'));
        }
        return view('occasions.create');
    }

    public function update(Request $request){
        $ruser = auth()->user();

        $data = request()->validate([
            'userName' => 'required|exists:App\User,name',
            'eventId' =>  'numeric'
        ]);

        //dd($data['groupId']);
        $user = User::where('name', $data['userName'])->first();
        $event = Occasion::where('id', $data['groupId'])->first();

        $group->users()->syncWithoutDetaching($user->id);
        Session::flash('message', 'You have added '.$user->name.' to group '.$group->name);

        //information needed for notification
        $group_info = $group->name;
        $user->notify(new addedToGroup($group_info));
        //return redirect('user/'.$ruser->id.'#groups')->with('message', 'You have added user to group '.$group->name);
    }

    public function checkTime(Object $event, Array $keyst) {
        //false brisi true nastavi
        if (empty($keyst)){
            return true;
        }
        $flag = true;
        $start_time = $event->start;
        //$start_hours = $event->start;
        //$start_hours = date('H:i');
        $start_hours = date('H:i', strtotime( $event->start));

        if($this->isWeekend(date($start_time)) && !in_array('weekend', $keyst)){
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

    //CHECK IF EVENTS HAVE FINISHED
    public function eventFinished(){

        $events = DB::table('occasions')->get();

        foreach ($events as $occasion) {
            if (strtotime($occasion->start) < time() && !$occasion->ended) {
                DB::table('occasions')->where('id', $occasion->id)->update(['ended' => true]);
            }
        }
    }

    public function delete_userevent(Occasion $occasion){
        $user = auth()->user();

        $occasion->users()->detach($user->id);
        return redirect('user/'. $user->id.'#events')->with('message', 'You have left the event');
    }
}


