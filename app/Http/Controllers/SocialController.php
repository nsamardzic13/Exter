<?php

namespace App\Http\Controllers;

use App\Availability;
use App\Hangout;
use App\Sport;
use App\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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

        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            //we take name first name + first 4 digits from google id and make username
            $username = $getInfo->user['given_name'];
            $id = substr($getInfo->id, 0, 4);
            $username .= '#'.$id;
            $validator = Validator::make($getInfo->user, [
                'email' => 'required|unique:App\User,email',
            ]);

            if($validator->fails()){

                $error = $validator->errors()->first();
                Redirect::route('login')->send()->with('login-error', $error);
            }

            $user = User::create([
                'name' => $username,
                'firstname' => $getInfo->user['given_name'],
                'lastname' => $getInfo->user['family_name'],
                'email'    => $getInfo->email,
                'user_type' => 'false',
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);

            $sport = new Sport();
            $hangout = new Hangout();
            $availability = new Availability();
            $user->sport()->save($sport);
            $user->hangout()->save($hangout);
            $user->availability()->save($availability);
        }
        return $user;
    }
}
