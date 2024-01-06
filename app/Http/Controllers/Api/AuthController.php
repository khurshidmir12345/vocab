<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=> 'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string',
        ]);

        $user = User::query()->create([
            'name'=> $fields['name'],
            'email'=> $fields['email'],
            'password'=> bcrypt($fields['password'])
        ]);

        Auth::login($user);

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];

        return response($response,201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'email'=>'required|string',
            'password'=>'required|string',
        ]);

        //Check email
        $user = User::query()->where('email',$fields['email'])->first();

        //Check password
        if (!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message'=>'Email or Password dos not correct'
            ],401);
        }
        Auth::login($user);
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'=>$user,
            'token'=>$token,
        ];

        return response($response,201);
    }

    public function logout(Request $request)
    {
        // Revoke the token that was used to authenticate the current request...
//        Auth::user()->currentAccessToken()->delete();

        $user = $request->user();
        // Sanctum uchun
        $user->tokens->each->delete();

        return response()->json(['message' => 'Successfully logged out']);
    }
}
