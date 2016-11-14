<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWord extends FormRequest
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
        $rules = [];
        $rules['content'] = 'required|max:50';
        $rules['answer.*'] = 'required|max:50';
        $rules['category_id'] = 'required|exists:categories,id';
        $rules['is_correct'] = 'required';

        return $rules;
    }
}
