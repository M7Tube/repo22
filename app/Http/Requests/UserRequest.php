<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>['required','string','max:48'],
            'email'=>['required','email','unique:users,email'],
            'password'=>['required','min:8','max:72'],
            'pic'=>['mimes:png,jpg,jpeg'],
            'department_id'=>['required','exists:departments,department_id']
        ];
    }
}
