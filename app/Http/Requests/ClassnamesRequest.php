<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassnamesRequest extends FormRequest
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
            'name' => 'required|max:30', // 必須、30文字以内
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '部署名は必須です',
            'name.max' => '部署名は30文字以内で入力してください',

        ];
    }
}
