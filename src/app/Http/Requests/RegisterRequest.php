<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'username' => 'required',
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
        ];
    }

    public function messages() {
        return [
            'username.required' => 'お名前を入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.unique' => 'このメールアドレスは既に登録されています',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'password.confirmed' => '',
            'password_confirmation.required' => 'パスワードと一致しません',
            'password_confirmation.min' => 'パスワードと一致しません',
        ];
    }
}
