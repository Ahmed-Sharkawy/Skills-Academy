<?php

namespace App\Http\Controllers\Api;

use App\Models\Cat;
use App\Http\Controllers\Controller;
use App\Http\Resources\Cat\CatResource;

class CatController extends Controller
{


  public function index()
  {
    return CatResource::collection(Cat::get());
  }



  // public function show($id)
  // {
  //   $cat  =  Cat::with('skills')->findOrFail($id);
  //   return new CatResource($cat);
  // }



  public function show(Cat $cat)
  {
    return CatResource::make($cat->load('skills'));
  }

}
