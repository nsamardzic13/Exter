<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;


class UsersController extends Controller
{
    public function index(User $user){
        //factory(User::class, 5)->create();
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
            'city' => 'nullable',
            'zip_code' => 'nullable|integer',
            'phone_number' => ['nullable' , 'regex:/(([+][(]?[0-9]{1,3}[)]?)|([(]?[0-9]{4}[)]?))\s*[)]?[-\s\.]?[(]?[0-9]{1,3}[)]?([-\s\.]?[0-9]{3})([-\s\.]?[0-9]{3,4})/'],
            'about_me' => 'nullable',
            'profile_pic' => 'sometimes|file|image|max:4000',
            'multiple_images.*' => 'sometimes|file|image|max:8000',
        ]);
//        dd((int)$data['birth_year']);
        $user->update([
            'birth_year' => $data['birth_year'],
            'street_name' => $data['address'],
            'city_name' => $data['city'],
            'zip_code' => $data['zip_code'],
            'phone_number' => $data['phone_number'],
            'description' => $data['about_me'],
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

//        dd($user);
        return redirect('user/' . $user->id);
    }
}
