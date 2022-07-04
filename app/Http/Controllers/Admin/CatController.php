<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cat;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Cat\CreateRequest;
use App\Http\Requests\Cat\UpdateRequest;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $cats  =  Cat::orderBy('id', 'DESC')->paginate(10);
    return view('admin.cats.index', compact('cats'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CreateRequest $request)
  {
    Cat::create([
      'name'  =>  json_encode([
        'en'  => $request->name_en,
        'ar'  => $request->name_ar,
      ]),
    ]);
    Toastr::success('Created Successfully');
    return back();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request)
  {
    Cat::findOrFail($request->id)->update([
      'name'  =>  json_encode([
        'en'  => $request->name_en,
        'ar'  => $request->name_ar,
      ]),
    ]);
    Toastr::success('Updated Successfully');
    return back();
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function toggle(Cat $cat)
  {
    $cat->update(['active'  =>  !$cat->active]);
    Toastr::success('Toggle Updated Success');
    return back();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Cat $cat)
  {
    try {
      $cat->delete();
      Toastr::success('Row Deleted Successfully');
    } catch (\Exception $e) {
      Toastr::info('Can`t delete this row');
    }
    return back();
  }
}
