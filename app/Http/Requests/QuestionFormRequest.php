<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuestionFormRequest extends Request
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
            'title'=>'required|max:100|min:1',
            'answer.*.title'=>'required|max:100|min:1',
            'score' => 'required|numeric|min:1|max:5'
        ];
    }
}
