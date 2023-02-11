<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserupRequest extends FormRequest
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
            //
            'name' => 'required|max:30', // 必須、30文字以内
            'email' => 'required', // 必須
            'class' => 'required', // 必須
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '名前は必須です',
            'name.max' => '名前は30文字以内で入力してください',
            'email.required' => 'メールアドレスは必須です',
            'class.required' => '部署は必須です',
        ];
    }
}
