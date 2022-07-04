<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{



  public function index()
  {
    $superadmin  =  Role::select('id')->where('name', 'superadmin')->first();
    $users      =  User::select('id', 'name', 'email', 'email_verified_at', 'role_id')->where('role_id', "!=", $superadmin->id)->orderBy('id', 'DESC')->paginate(10);;

    return view('admin.admin.index', compact('users'));
  }



  public function create()
  {
    return view('admin.admin.create');
  }



  public function store(CreateRequest $request)
  {
    $user  =  User::create(['role_id' => 2, 'password' => Hash::make($request->password)] + $request->validated());
    event(new Registered($user));
    Toastr::success('Created Admin Successfully');
    return redirect()->route('dashboard.admin.index');
  }



  public function promotion($id)
  {
    User::findOrFail($id)->update(['role_id'  =>  Role::select('id')->where('name', 'admin')->first()->id]);
    Toastr::info('Updated Role Admin Successfully');
    return redirect()->route('dashboard.admin.index');
  }



  public function rebate($id)
  {
    User::findOrFail($id)->update(['role_id'  =>  Role::select('id')->where('name', 'student')->first()->id]);
    Toastr::info('Updated Role Admin Successfully');
    return redirect()->route('dashboard.admin.index');
  }
};
