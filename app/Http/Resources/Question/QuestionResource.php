<?php

namespace App\Http\Resources\Question;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
      'id'            =>  $this->id,
      'title'         =>  $this->title,
      'option_1'      =>  $this->option_1,
      'option_2'      =>  $this->option_2,
      'option_3'      =>  $this->option_3,
      'option_4'      =>  $this->option_4,
      'right_ans'     =>  $this->right_ans,
      'created_at'    =>  $this->created_at,
      'updated_at'    =>  $this->updated_at,
    ];
  }
}
