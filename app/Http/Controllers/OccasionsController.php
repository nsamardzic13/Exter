<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use \App\Occasion;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        $occasions = DB::table('occasions')->select(DB::raw('min(id) as id, name, street, city, min(start) as start, user_name, max_people, description, category, picture'))
            ->where('ended', 'false')
            ->groupBy('name', 'user_name', 'street', 'city', 'category', 'description', 'max_people', 'picture')
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
                'city' => 'required|min:3',
                'zipcode' => 'required|min:3',
                'when' => 'required',
                'max_people' => 'required|numeric|min:2',
                'description' => 'required|min:10|max:255',
                'category' => 'required|min:3',
                'picture' => 'sometimes|file|image|max:4000',

            ]);
            unset($data['when']);
            $ntime = request('number-times');
            //dd(request()->all());
            for ($i = 1; $i <= $ntime; $i = $i + 1) {
                $when = request()->validate([
                    'repeat' => 'required',
                    'start' => 'required|date|after:today',
                    'time-start' . $i => 'required|date_format:H:i',
                    'time-end' . $i => 'required|date_format:H:i',
                    'day' . $i => 'required|array|between:1,7',
                ]);

            }

            //dd($data);
            //dd($when);
            $startdate = strtotime(request('start'));
            $enddate = $startdate + (request('repeat') * 86400);

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

                            $occasion = Occasion::create(array_merge($data, ['start' => $sdate], ['end' => $edate], ['user_name' => $user->name]));
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
                'city' => 'required|min:3',
                'zipcode' => 'required|min:3',
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

            $enddate = request('end-one') . ' ' . request('time-end-one');;
            $enddate = Carbon::createFromFormat('Y-m-d H:i', $enddate);

            $occasion = Occasion::create(array_merge($data, ['start' => $startdate], ['end' => $enddate], ['user_name' => $user->name]));

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

    public static function wall(Occasion $occasion)
    {

        $user = auth()->user();
        $occasion->users()->syncWithoutDetaching($user->id);

        $joined = $occasion->users;

        return view('occasions.wall', compact('joined', 'occasion'));
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
}
