<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWord extends FormRequest
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
        $rules['answer.*'] = 'required|max:10';
        $rules['category_id'] = 'required|exists:categories,id';
        $rules['is_correct'] = 'required';

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        foreach($this->request->get('answer') as $key => $value) {
            $messages['answer.' . $key . '.max'] = 'The answer ' . $key . ' must be less than :max characters.';
            $messages['answer.' . $key . '.required'] = 'The answer ' . $key . ' must be required.';
        }

        return $messages;
    }
}
