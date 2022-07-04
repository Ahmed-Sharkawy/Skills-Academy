<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Question\CreateRequest;
use App\Http\Requests\Question\UpdateRequest;
use App\Models\Exam;
use App\Models\Question;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{


  public function create(Exam $exam)
  {
    if (session('prev') !== $exam->id) {
      return redirect()->route('dashboard.exam.index');
    }

    return view('admin.questions.create', ['exam_id' => $exam->id, 'questions_no' => $exam->questions_no]);
  }


  public function store(CreateRequest $request, Exam $exam)
  {
dd($request);
    for ($i = 0; $i < $exam->questions_no; $i++) {
      Question::create([
        'title'     =>  $request->titles[$i],
        'right_ans' =>  $request->right_ans[$i],
        'option_1'  =>  $request->option_1s[$i],
        'option_2'  =>  $request->option_2s[$i],
        'option_3'  =>  $request->option_3s[$i],
        'option_4'  =>  $request->option_4s[$i],
        'exam_id'   =>  $exam->id,
      ]);
    }

    $exam->update(['active' => 1]);

    Toastr::success('Ceated Questions Successfully');
    return redirect()->route('dashboard.exam.index');
  }


  public function show(Exam $exam)
  {
    return view('admin.questions.show', compact('exam'));
  }


  public function edit(Exam $exam ,Question $question)
  {
    return view('admin.questions.edit', compact('exam' , 'question'));
  }


  public function update(Exam $exam, Question $question,UpdateRequest $request)
  {
    $question->update($request->validated());
    Toastr::success('Update Questions Successfully');
    return redirect()->route('dashboard.question.show',$exam->id);
  }


}
