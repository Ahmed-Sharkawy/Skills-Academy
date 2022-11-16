<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cat;

class CatController extends Controller
{

    public function show(Cat $cat)
    {
        $allCategory = Cat::with('skills')->active()->get(['id', 'name']);
        $skills      = $cat->load('skills')->active()->paginate(4);

        return view('Web.cates.show', compact('cat', 'allCategory', 'skills'));
    }
}
