<?php

namespace App\Http\Controllers;

use App\Messages;
use App\User;
use Carbon\Carbon;

use Illuminate\Http\Request;

use \App\Occasion;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Spatie\Geocoder\Facades\Geocoder;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;


class OccasionsController extends Controller
{
    public function index()
    {

        $user = auth()->user();

        $events = DB::table('occasions')->get();


        foreach ($events as $occasion) {
            if (strtotime($occasion->start) < time() && !$occasion->ended) {
                DB::table('occasions')->where('id', $occasion->id)->update(['ended' => true]);

            }
        }
        $occasions = DB::table('occasions')->select(DB::raw('min(id) as id, name, street, min(start) as start, user_name, max_people, description, category, picture'))
            ->where('ended', 'false')
            ->groupBy('name', 'user_name', 'street', 'category', 'description', 'max_people', 'picture')
            ->orderBy('start')
            ->paginate(12);

        return view('occasions.index', compact('user', 'occasions'));
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

            $days = ['Monday', 'Tuesday', 'Wendsday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


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

            if ($data['street'] == $streetInDatabase->street) {
                $lat = $streetInDatabase->lat;
                $lng = $streetInDatabase->lng;
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

            if ($data['street'] == $streetInDatabase->street) {
                $lat = $streetInDatabase->lat;
                $lng = $streetInDatabase->lng;
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


        return redirect('events')->with('message', 'You have succesfuly created event');;
    }

    public static function showTimesForModal($occasion)
    {
        $time = DB::table('occasions')->where('name', $occasion->name)->where('ended', false)->orderBy('start')->get();
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

        $otherusers =  array_values($request->input())[0];

        foreach ($otherusers as $otheruser){
            $occasion->users()->syncWithoutDetaching($otheruser);
        }
        $occasion->users()->syncWithoutDetaching($user->id);
        $joined = $occasion->users;

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
}
