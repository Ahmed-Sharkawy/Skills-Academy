<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Skill;

class SkillController extends Controller
{


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $skill    = Skill::with('exams')->active()->findOrFail($id);
        $exams    = $skill->exams()->active()->paginate(6);

        return view('Web.skills.show', compact('skill', 'exams'));
    }
}
