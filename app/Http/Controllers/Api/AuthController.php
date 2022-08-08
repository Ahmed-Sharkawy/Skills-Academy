<?php

namespace App\Http\Controllers\Api;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{



  public function register(Request $request)
  {

    $validator  =  Validator::make($request->all(), [
      'name'      =>  'required|string|max:255|min:4',
      'email'     =>  'required|email|max:255',
      'password'  =>  'required|string|confirmed|min:5|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors());
    }

    $studentRole  = Role::where('name', "student")->first();

    $user  =  User::create(['password' => Hash::make($request->password), 'role_id' =>  $studentRole->id]  + $validator->validated());

    $token  =  $user->createToken($user);

    return response()->json(['token'  =>  $token->plainTextToken]);
  }



  public function login(Request $request)
  {
    $validator  =  Validator::make($request->all(), [
      'email'     =>  'required|email|max:255',
      'password'  =>  'required|string|min:5|max:255',
    ]);

    if ($validator->fails()) {
      return response()->json($validator->errors());
    }

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $token  =  auth()->user()->createToken('token');
      return response()->json(['token' => $token->plainTextToken]);
    }

    return response()->json(['message' => 'Credentials are not correct']);
  }



  public function me()
  {
    return response()->json(auth()->user());
  }

  public function logout()
  {
    auth()->user()->tokens()->delete();
    return response()->json(['message' => 'Logout Successfully']);
  }
}
