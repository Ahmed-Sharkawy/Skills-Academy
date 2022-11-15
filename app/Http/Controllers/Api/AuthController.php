<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $studentRole = Role::where('name', "student")->first();

        $user = User::create(['password' => Hash::make($request->password), 'role_id' =>  $studentRole->id]  + $request->validated());

        $user['token'] = $user->createToken($user)->plainTextToken;

        return response()->json([
            'user' => $user
        ]);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user  = Auth::user();
            $user['token'] =  auth()->user()->createToken($user)->plainTextToken;

            return response()->json([
                'user' => $user
            ]);
        }

        return response()->json(['message' => 'Credentials are not correct']);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout Successfully']);
    }
}
