<?php

namespace App\Http\Controllers\Api;

use App\Models\Exam;
use App\Http\Controllers\Controller;
use App\Http\Resources\Exam\ExamResource;

class ExamController extends Controller
{

    public function index(Exam $exam)
    {
        return new ExamResource($exam);
    }

    public function show(Exam $exam)
    {
        // $Exam  =  Exam::with('questions')->findOrFail($id);
        return new ExamResource($exam->load('questions'));
    }

}
