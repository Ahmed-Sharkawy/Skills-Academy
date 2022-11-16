<?php

namespace App\Http\Requests\Question;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'titles'      =>  'required|array',
            'titles.*'    =>  'required|max:255',
            'right_ans'   =>  'required|array',
            'right_ans.*' =>  'required|numeric|integer|in:1,2,3,4',
            'option_1s'   =>  'required|array',
            'option_2s'   =>  'required|array',
            'option_3s'   =>  'required|array',
            'option_4s'   =>  'required|array',
            'option_1s.*' =>  'required|string|max:255',
            'option_2s.*' =>  'required|string|max:255',
            'option_3s.*' =>  'required|string|max:255',
            'option_4s.*' =>  'required|string|max:255',
        ];
    }
}
