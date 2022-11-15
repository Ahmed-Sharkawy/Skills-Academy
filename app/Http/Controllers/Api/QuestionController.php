<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function start($examId)
    {

        $user  =  auth()->user();
        $userQuestions = $user->exams()->where('exam_id', $examId)->first();

        if (!$userQuestions) {
            $user->exams()->attach($examId);
        } else {
            $user->exams()->updateExistingPivot($examId, ['status'  =>  'closed']);
        }
        return response()->json(['message' =>  'you started exam']);
    }



    public function submit(Request $request, $examId)
    {

        $validator  =  Validator::make($request->all(), [
            'answers'   =>  'array',
            'answers.*' =>  'in:1,2,3,4'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
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

        // // Calculation Time Mins
        $user        = Auth::user();
        $pivotRow    = $user->exams()->where('exam_id', $examId)->first();
        $startTime   = $pivotRow->pivot->updated_at;
        $submitTime  =  Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);

        if ($timeMins > $pivotRow->duration_mins) {
            $score  = 0;
        }

        // // update pivot row

        $user->exams()->updateExistingPivot($examId, [
            'score'       =>  $score,
            'time_mins'   =>  $timeMins,
            'status'      =>  'closed'
        ]);

        return response()->json(['message'  =>  "you submitted exam successfully, youe score is $score%"]);
    }
}
