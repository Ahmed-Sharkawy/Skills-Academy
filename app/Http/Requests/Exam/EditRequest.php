<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
      'name_en'       => 'required|string|max:70',
      'name_ar'       => 'required|string|max:70',
      'skill_id'      => 'required|numeric|integer|exists:skills,id',
      'image'         => 'nullable|image',
      'duration_mins' => 'required|numeric|integer|min:1',
      'difficulty'    => 'required|numeric|min:1|max:5',
      'desc_en'       => 'required|string',
      'desc_ar'       => 'required|string',
    ];
  }
}
