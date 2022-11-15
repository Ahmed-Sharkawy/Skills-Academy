<?php

namespace App\Http\Resources\Skill;

use App\Http\Resources\Exam\ExamResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SkillResource extends JsonResource
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
            'id'          =>  $this->id,
            'name_en'     =>  $this->name('en'),
            'name_ar'     =>  $this->name('ar'),
            'active'      =>  $this->active,
            'image'       =>  asset("uploads/skills/$this->image"),
            'created_at'  =>  $this->created_at,
            'updated_at'  =>  $this->updated_at,
            'exams'       =>  ExamResource::collection($this->whenLoaded('exams'))
        ];
    }
}
