<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cat;

class CatController extends Controller
{

  public function show(Cat $cat)
  {
    $allCategory  =  Cat::active()->get(['id', 'name']);
    $skills       =  $cat->skills()->active()->paginate(6);

    return view('Web.cates.show', compact('cat', 'allCategory', 'skills'));
  }
}
