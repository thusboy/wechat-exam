<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MobileFormReuquest extends Request
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
            "mobile" => "required|numeric|max:19000000000|min:13000000000"
        ];
    }
}
