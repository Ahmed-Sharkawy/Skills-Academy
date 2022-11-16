<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitFormRequest;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{

    public function show($id)
    {
        $exam     = Exam::active()->findOrFail($id);
        $pivotRow = Auth::user()->exams()->select('status')->where('exam_id', $id)->first();
        return view('Web.Exam.show', compact('exam', 'pivotRow'));
    }

    public function start(Request $request, $examId)
    {
        $user  =  Auth::user();
        $userQuestions = $user->exams()->where('exam_id', $examId)->first();

        if (!$userQuestions) {
            $user->exams()->attach($examId);
        } else {
            $user->exams()->updateExistingPivot($examId, ['status'  =>  'closed']);
        }

        $request->session()->flash('prev', "start/$examId");

        return redirect()->route('exam.question', $examId);
    }


    public function question($examId, Request $request)
    {

        if (session('prev') !== "start/$examId") {
            return redirect()->route('exam.show', $examId);
        }

        $exam       = Exam::findOrFail($examId);
        $questions  = $exam->questions;

        $request->session()->flash('prev', "question/$examId");

        return view('Web.Exam.question', compact('exam', 'questions'));
    }


    public function submit(SubmitFormRequest $request, $examId)
    {
        if (session('prev') !== "question/$examId") {
            return redirect()->route('exam.show', $examId);
        }

        // Calculation Score
        $exam  =  Exam::findOrFail($examId);

        $points  = 0;
        $totleQuesNum =  $exam->questions->count();

        foreach ($exam->questions as  $questions) {

            if (isset($request->answers[$questions->id])) {

                $userAns    = $request->answers[$questions->id];
                $right_ans  = $questions->right_ans;

                if ($userAns == $right_ans) {
                    $points += 1;
                }
            }
        }

        $score  = ($points / $totleQuesNum) * 100;

        // Calculation Time Mins
        $user        = Auth::user();
        $pivotRow    = $user->exams()->where('exam_id', $examId)->first();
        $startTime   = $pivotRow->pivot->updated_at;
        $submitTime  =  Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);

        if ($timeMins > $pivotRow->duration_mins) {
            $score  = 0;
        }

        // update pivot row

        $user->exams()->updateExistingPivot($examId, [
            'score'       =>  $score,
            'time_mins'   =>  $timeMins,
            'status'      =>  'closed'
        ]);

        Toastr::success("The test was successfully passed and I got $score%");
        return redirect()->route('exam.show', $examId);
    }
}
