<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{

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
            'phone_number' => 'nullable',
            'about_me' => 'nullable',
            'profile_pic' => 'sometimes|file|image|max:4000',
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
            $image = Image::make(public_path('storage/' . $user->profile_pic))->fit(200,200);
            $image->save();
        }

//        dd($user);
        return redirect('user/' . $user->id);
    }
}
