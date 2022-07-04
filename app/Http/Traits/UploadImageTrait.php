<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
  public function uploadImage($request, $name, $pas)
  {
    if ($request->hasFile($request->$name)) {
      $ext = $name->getClientOriginalExtension();
      $newName = date('Y-m-d') . '_' . uniqid() . '.' . $ext;
      $destinationPath = public_path($pas);
      $name->move($destinationPath, $newName);
      return $newName;
    }
  }

  public function deletImage($pas)
  {
    if (File::exists($pas)) {
      File::delete($pas);
    }
  }
}
