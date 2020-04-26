<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;


class UsersController extends Controller
{
    public function index(User $user){
        //factory(User::class, 5)->create();
        //dd(Auth::user()->notifications[0]['data']);
        /*foreach (Auth::user()->notifications as $notify){
            dd($notify['id']);
        }*/

        //dd(count((Auth::user()->unreadNotifications)));

        return view('user.index', compact('user'));
    }


    public function edit(User $user) {
        //get current user
        $user = auth()->user();
//        dd($user);
        return view('user.edit', compact('user'));
    }

    public function update(User $user) {
        //get data from request
        $data = request()->validate([
            'birth_year' => 'nullable|integer',
            'address' => 'nullable',
            'name' => 'nullable|unique:App\User,name,'.$user->id,
            'city' => 'nullable',
            'zip_code' => 'nullable|integer',
            'phone_number' => ['nullable' , 'regex:/(([+][(]?[0-9]{1,3}[)]?)|([(]?[0-9]{4}[)]?))\s*[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?([-\s\.]?[0-9]{3})([-\s\.]?[0-9]{3,4})/'],
            'about_me' => 'nullable',
            'profile_pic' => 'sometimes|file|image|max:4000',
            'multiple_images.*' => 'sometimes|file|image|max:8000',
            'user_type' => 'required',
        ]);
//        dd((int)$data['birth_year']);
        $user->update([
            'name' => $data['name'],
            'birth_year' => $data['birth_year'],
            'street_name' => $data['address'],
            'city_name' => $data['city'],
            'zip_code' => $data['zip_code'],
            'phone_number' => $data['phone_number'],
            'description' => $data['about_me'],
            'user_type' => $data['user_type'],
        ]);

        //check if image is submited
        if(request()->has('profile_pic')) {
            $user->update([
               'profile_pic' => request()->profile_pic->store('uploads', 'public'),
            ]);

            //resize photo
            $image = Image::make(public_path('storage/' . $user->profile_pic))->fit(128,128);
            $image->save();
        }

        if($user->user_type == True){
            if(request()->has('multiple_images')) {
                foreach($data['multiple_images'] as $img) {
                    $img_name = $img->store('uploads', 'public');
                    $img_data[] = $img_name;
                }

                if($user->user_gallary) {
                    foreach(json_decode($user->user_gallary) as $img) {
                        $img_data[] = $img;
                    }
                }

                $user->update([
                    'user_gallary' => json_encode($img_data),
                ]);
            }
        }
        return redirect('user/' . $user->id);
    }

    public function history(){

        $user = auth()->user();

        $user_events = DB::table('users')->join('occasion_user', 'users.id', '=', 'occasion_user.user_id')
            ->join('occasions', 'occasion_user.occasion_id', '=', 'occasions.id')
            ->where('occasions.ended', 'true')
            ->where('occasion_user.user_id', $user->id)
            ->orderByDesc('end')
            ->paginate(5);

        return view('user.occasionHistory', compact('user_events', 'user'));

    }
}
