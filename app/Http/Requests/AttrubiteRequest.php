<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttrubiteRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:48'],
            'is_required' => ['boolean'],
            'template_id' => ['required', 'integer', 'exists:templates,template_id'],
            'category_id' => ['required', 'integer', 'exists:report_categories,category_id']
        ];
    }
}
