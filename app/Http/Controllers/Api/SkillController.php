<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Skill\SkillResource;

class SkillController extends Controller
{

    public function index()
    {
        $skills = Skill::active()->with('exams')->get();
        return SkillResource::collection($skills);
    }

    public function show(Skill $skill)
    {
        // $Skill = Skill::with('exams')->findOrFail($id);
        return new SkillResource($skill->load('exams'));
    }

}
