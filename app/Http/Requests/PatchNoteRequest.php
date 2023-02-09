<?php

namespace App\Http\Requests;

use HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class PatchNoteRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'required|string',
            'text' => 'required|string',
            'date' => 'required|date',
            'link' => 'nullable|string|max:50',
            'tag' => 'nullable|string'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Type is Required!',
            'text.required' => 'Text is Required!',
            'date.required' => 'Date is Required!',
            'link.nullable' => 'Link Empty',
            'tag.nullable' => 'Tag Empty'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return [
            'success' => false,
            'messages' =>$validator->errors()->first(),
            'data' => null
        ];
    }
}
