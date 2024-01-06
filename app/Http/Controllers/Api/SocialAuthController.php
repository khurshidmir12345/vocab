<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {

        try {
            $googleUser = Socialite::driver('google')->stateless()->user();


            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password'=>bcrypt('noPassword'),
                    'google_id' => $googleUser->getId(),
                    'google_token' => $googleUser->token,
                    'google_refresh_token' => $googleUser->refreshToken ?? null,

                ]);
            }

            Auth::login($user);
            $token = $user->createToken('myapptoken')->plainTextToken;


            return response()->json([
                'message' => 'User logged in successfully',
                'user' => new UserResource($user),
                'token'=> $token
            ]);

        } catch (Exception $e) {

            return response()->json(['error' => 'Authentication failed'], 401);
        }
    }

}
