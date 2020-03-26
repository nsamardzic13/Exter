<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        $getInfo = Socialite::driver($provider)->user();

        $user = $this->createUser($getInfo,$provider);

        auth()->login($user);

        return redirect()->to('/user/'.$user->id);

    }
    function createUser($getInfo,$provider){

        //we take name first name + first 4 digits from google id and make username
        $username = $getInfo->user['given_name'];
        $id = substr($getInfo->id, 0, 4);
        $username .= '#'.$id;
        $validator = Validator::make($getInfo->user, [
            'email' => 'required|unique:App\User,email',
        ]);

        if($validator->fails()){
            //return redirect()->route('register');
            //return redirect()->route('login');
            echo 'That email address is already registered. You sure you don\'t have an account?';
            //return redirect()->back()->with('error', 'Credentials not matched !');
        }

        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {

            $user = User::create([
                'name' => $username,
                'firstname' => $getInfo->user['given_name'],
                'lastname' => $getInfo->user['family_name'],
                'email'    => $getInfo->email,
                'user_type' => 'false',
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
