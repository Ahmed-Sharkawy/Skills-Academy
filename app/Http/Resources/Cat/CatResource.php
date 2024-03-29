<?php

namespace App\Http\Resources\Cat;

use App\Http\Resources\Skill\SkillResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CatResource extends JsonResource
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
            'created_at'  =>  $this->created_at,
            'updated_at'  =>  $this->updated_at,
            'skills'      =>  SkillResource::collection($this->whenLoaded('skills'))
        ];
    }
}
