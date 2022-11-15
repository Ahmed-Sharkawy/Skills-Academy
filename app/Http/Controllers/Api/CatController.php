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

    public function show(Cat $cat)
    {
        return new CatResource($cat->load('skills'));
    }

    // public function show($id)
    // {
    //     $cat  =  Cat::with('skills')->findOrFail($id);
    //     return new CatResource($cat);
    // }

}
