<?php

namespace App\Http\Controllers\Admin;

use App\Models\Cat;
use App\Models\Skill;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Traits\UploadImageTrait;
use App\Http\Requests\Skills\StoreRequest;
use App\Http\Requests\Skills\UpdateRequest;

class SkillController extends Controller
{

    use UploadImageTrait;

    public function index()
    {
        $skills   =  Skill::orderBy('id', 'DESC')->paginate(10);
        $cats     =  Cat::select('id', 'name')->get();
        return view('admin.skill.index', compact('skills', 'cats'));
    }

    public function store(StoreRequest $request)
    {
        $image  =  $this->uploadImage($request, $request->image, "uploads/skills");

        Skill::create([
            'name'    =>  json_encode([
                'en'    =>  $request->name_en,
                'ar'    =>  $request->name_ar,
            ]),
            'image'   =>  $image,
            'cat_id'  =>  $request->cat_id,
        ]);

        Toastr::success('Ceated Successfully');
        return back();
    }

    public function update(UpdateRequest $request)
    {
        $skill  =  Skill::findOrFail($request->id);
        $image  =  $skill->image;

        if ($request->image) {
            $this->deletImage("uploads/skills/$skill->image");
            $image  =  $this->uploadImage($request, $request->image, "uploads/skills");
        }

        $skill->update([
            'name'  =>  json_encode([
                'en'  => $request->name_en,
                'ar'  => $request->name_ar,
            ]),
            'image'   =>  $image,
            'cat_id'  =>  $request->cat_id,
        ]);

        Toastr::success('Updated Successfully');
        return back();
    }

    public function toggle(Skill $skill)
    {
        $skill->update(['active'  =>  !$skill->active]);
        Toastr::success('Toggle Updated Success');

        return back();
    }

    public function destroy(Skill $skill)
    {
        try {
            $this->deletImage("uploads/skills/" . $skill->image);
            $skill->delete();
            Toastr::success('Row Deleted Successfully');
        } catch (\Exception $e) {
            Toastr::info('Can`t delete this row');
        }

        return back();
    }
}
