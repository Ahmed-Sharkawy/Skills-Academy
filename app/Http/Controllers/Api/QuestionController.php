<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Question\SubmitRequest;

class QuestionController extends Controller
{

    public function start($examId)
    {
        $user  =  auth()->user();
        $userQuestions = $user->exams()->where('exam_id', $examId)->first();

        if (! $userQuestions) {
            $user->exams()->attach($examId);
        } else {
            $user->exams()->updateExistingPivot($examId, ['status'  =>  'closed']);
        }

        return response()->json(['message' =>  'you started exam']);
    }

    public function submit(SubmitRequest $request, Exam $exam)
    {
        // Calculation Score
        $user    = Auth::user();
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

        // // Calculation Time Mins
        $pivotRow    = $user->exams()->where('exam_id', $exam->id)->first();
        $startTime   = $pivotRow->pivot->updated_at;
        $submitTime  =  Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);

        if ($timeMins > $pivotRow->duration_mins) {
            $score  = 0;
        }

        // update pivot row

        $user->exams()->updateExistingPivot($exam->id, [
            'score'       =>  $score,
            'time_mins'   =>  $timeMins,
            'status'      =>  'closed'
        ]);

        return response()->json(['message'  =>  "you submitted exam successfully, youe score is $score%"]);
    }
}
