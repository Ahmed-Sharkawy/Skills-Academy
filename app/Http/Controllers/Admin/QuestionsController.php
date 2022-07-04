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
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Exam $exam)
  {
    // if (session('prev') !== $exam->id) {
    //   return redirect()->route('dashboard.exam.index');
    // }

    return view('admin.questions.create', ['exam_id' => $exam->id, 'questions_no' => $exam->questions_no]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Exam $exam)
  {

    // dd($request->all());

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

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Exam $exam)
  {
    return view('admin.questions.show', compact('exam'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Exam $exam ,Question $question)
  {
    return view('admin.questions.edit', compact('exam' , 'question'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Exam $exam, Question $question,UpdateRequest $request)
  {
    $question->update($request->validated());
    Toastr::success('Update Questions Successfully');
    return redirect()->route('dashboard.question.show',$exam->id);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
