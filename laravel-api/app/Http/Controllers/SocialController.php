<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialAccount;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

        public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();

        $authUser = User::firstOrCreate([
            'email' => $providerUser->getEmail(),
        ], [
            'name' => $providerUser->getName(),
        ]);

        $socialAccount = SocialAccount::firstOrCreate([
            'user_id' => $authUser->id,
            'provider' => $provider,
            'provider_id' => $providerUser->getId(),
        ], [
            'token' => $providerUser->token,
            'token_secret' => $providerUser->tokenSecret ?? null,
        ]);

        $socialAccount->update([
            'token' => $providerUser->token,
            'token_secret' => $providerUser->tokenSecret ?? null,
        ]);

        auth()->login($authUser, true);

        return response()->json($authUser);
    }
}

