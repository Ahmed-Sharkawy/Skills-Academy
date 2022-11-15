<?php

namespace App\Http\Resources\Exam;

use App\Http\Resources\Question\QuestionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'              =>  $this->id,
            'name_en'         =>  $this->name('en'),
            'name_ar'         =>  $this->name('ar'),
            'desc_en'         =>  $this->desc('en'),
            'desc_ar'         =>  $this->desc('ar'),
            'questions_no'    =>  $this->questions_no,
            'difficulty'      =>  $this->difficulty,
            'duration_mins'   =>  $this->duration_mins,
            'active'          =>  $this->active,
            'image'           =>  asset("uploads/exams/$this->image"),
            'created_at'      =>  $this->created_at,
            'updated_at'      =>  $this->updated_at,
            'questions'       =>  QuestionResource::collection($this->whenLoaded('questions'))
        ];
    }
}
