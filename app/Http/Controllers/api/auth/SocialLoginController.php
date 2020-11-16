<?php

namespace App\Http\Controllers\api\auth;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Customer\Customer;
use App\Models\Customer\CustomerSocial;

class SocialLoginController extends Controller
{
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->stateless()->redirect();
    }
    public function handleProviderCallback($service)
    {
        try {
            $serviceUser = Socialite::driver($service)->stateless()->user();
        } catch (Exception $e) {
            return redirect(env('CLIENT_BASE_URL') . '?error=Unable to login using' . $service . '. Please try again.');
        }
        $email = $serviceUser->getEmail();
        $socialAccessToken = $serviceUser->token;
        //    if ($service != 'google'){
        //        $email = $serviceUser->getId().'@'.$service.'.local';
        //    }else {
        //        $email = $serviceUser->getEmail();
        //   }

        $user = $this->getExistingUser($serviceUser, $email, $service);
        $newUser = false;
        if (!$user) {
            $newUser = true;
            $user = Customer::create([
                'name' => $serviceUser->getName(),
                'email' => $email,
                'password' => null

            ]);
        }

        if ($this->needsToCreateSocial($user, $service)) {
            CustomerSocial::create([
                'user_id' => $user->id,
                'social_id' => $serviceUser->getId(),
                'service' => $service
            ]);
        }

        Auth::login($user);

        if (Auth::check()) {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return redirect(env('CLIENT_BASE_URL') . '/auth/social-callback?token=' . $accessToken);
        } else {
            return response()->json(['error' => 'social login error']);
        }
    }

    public function needsToCreateSocial(Customer $user, $service)
    {
        return !$user->hasSocialLinked($service);
    }

    public function getExistingUser($serviceUser, $email, $service)
    {
        if ($service != 'google') {
            $userSocial = CustomerSocial::where('social_id', $serviceUser->getId())->first();
            return $userSocial ? $userSocial->user : null;
        } else return Customer::where('email', $email)->orWhereHas('social', function ($q) use ($serviceUser, $service) {
            $q->where('social_id', $serviceUser->getId())->where('service', $service);
        })->first();
    }
}
