<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'profile_image' => 'mimes:jpeg,png',
            'username' => ['required', 'max:20'],
            'postcode' => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address' => 'required',
            'building' => 'nullable',
        ];
    }

    public function messages() {
        return [
            'profile_image.mimes' => 'プロフィール画像はjpegまたはpngのみアップロードできます',
            'username.required' => 'お名前を入力してください',
            'username.max' => 'お名前は20文字以内で入力してください',
            'postcode.required' => '郵便番号を入力してください',
            'postcode.regex' => '郵便番号はハイフンありの8文字で入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
