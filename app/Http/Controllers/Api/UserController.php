<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::query()->with(['vokabs'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $fields = $request->validate([
//            'name'=> 'required|string',
//            'email'=>'required|string|unique:users,email',
//            'password'=>'required|string',
//        ]);
//
//        $user = User::query()->create([
//            'name'=> $fields['name'],
//            'email'=> $fields['email'],
//            'password'=> bcrypt($fields['password'])
//        ]);
//
//        $token = $user->createToken($fields['name'])->plainTextToken;
//
//        $response = [
//            'user'=>$user,
//            'token'=>$token,
//        ];
//
//        return response($response,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): UserResource
    {
        return new UserResource(User::query()->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'name'=> 'required|string',
            'email'=>'required|string',
            'password'=>'required|string',
        ]);
        $user = User::query()->find($id);
        $user->update($request->all());

        return response($user,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::query()->find($id);
        $user->delete();

        return [
            'message'=>'deleted user'
        ];
    }
}
