<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exam;
use App\Models\Skill;
use App\Http\Controllers\Controller;
use App\Http\Requests\Exam\CreateRequest;
use App\Http\Requests\Exam\EditRequest;
use App\Http\Traits\UploadImageTrait;
use Brian2694\Toastr\Facades\Toastr;

class ExamController extends Controller
{
    use UploadImageTrait;

    public function index()
    {
        $exams  =  Exam::select('id', 'name', 'image', 'questions_no', 'skill_id', 'active')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.exam.index', compact('exams'));
    }

    public function create()
    {
        $skills  =  Skill::select('id', 'name')->get();
        return view('admin.exam.create', compact('skills'));
    }

    public function store(CreateRequest $request)
    {
        $nameImage  =  $this->uploadImage($request, $request->image, "uploads/exams");

        $exam  =  Exam::create([
            'name'    =>  json_encode(['en'  =>  $request->name_en, 'ar'  =>  $request->name_ar]),
            'desc'    =>  json_encode(['en'  =>  $request->desc_en, 'ar'  =>  $request->desc_ar]),
            'image'   =>  $nameImage,
            'active'  =>  0,
        ] + $request->validated());

        $request->session()->put('prev', $exam->id);
        Toastr::success('Created Exam Successfully');
        return redirect()->route('dashboard.question.create', $exam->id);
    }

    public function show(Exam $exam)
    {
        return view('admin.exam.show', compact('exam'));
    }

    public function toggle(Exam $exam)
    {
        if ($exam->questions_no == $exam->questions()->count()) {

            $exam->update(['active'  =>  !$exam->active]);
            Toastr::success('Toggle Updated Successfully');

            return redirect()->route('dashboard.exam.index');
        }

        Toastr::info('Please fill in the remaining questions');
        return redirect()->route('dashboard.exam.index');
    }

    public function edit(Exam $exam)
    {
        $skills  =  Skill::select('id', 'name')->get();
        return view('admin.exam.edit', compact('exam', 'skills'));
    }

    public function update(EditRequest $request, Exam $exam)
    {
        $nameImage  =  $exam->image;

        if ($request->image) {
            $this->deletImage("uploads/exams/$exam->image");
            $nameImage  =  $this->uploadImage($request, $request->image, "uploads/exams");
        }

        $exam->update([
            'name'  =>  json_encode(['en'  => $request->name_en, 'ar'  => $request->name_ar]),
            'desc'    =>  json_encode(['en'  =>  $request->desc_en, 'ar'  =>  $request->desc_ar]),
            'image'   =>  $nameImage,
        ] + $request->validated());

        Toastr::success('Updated Successfully');
        return redirect()->route('dashboard.exam.show', $exam->id);
    }

    public function destroy(Exam $exam)
    {
        try {
            $this->deletImage("uploads/skills/" . $exam->image);
            $exam->questions()->delete();
            $exam->delete();
            Toastr::success('Row Deleted Successfully');
        } catch (\Exception $e) {
            Toastr::info('Can`t delete this row');
        }

        return redirect()->route('dashboard.exam.index');
    }
}
