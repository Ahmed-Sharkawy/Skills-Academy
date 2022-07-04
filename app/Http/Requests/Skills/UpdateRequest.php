<?php

namespace App\Http\Requests\Skills;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'id'        =>  'required|integer|numeric|exists:skills,id',
      'name_en'   =>  'required|string|max:50',
      'name_ar'   =>  'required|string|max:50',
      'image'     =>  'nullable|image',
      'cat_id'    =>  'required|integer|numeric|exists:cats,id',
    ];
  }
}
