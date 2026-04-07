@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/register.css') }}" />
@endsection

@section('content')

<div class="register-page">
    <h1 class="form__heading">会員登録</h1>
    <div class="form__content">
        <form class="form" action="{{ route('register') }}" method="post" novalidate>
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <label for="username" class="form__label--item">ユーザー名</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="username" id="username" name="username" value="{{ old('username') }}" />
                    </div>
                    <div class="form__error">
                        @error('username')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="email" class="form__label--item">メールアドレス</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" />
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="password" class="form__label--item">パスワード</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" id="password" name="password" />
                    </div>
                    <div class="form__error">
                        @error('password')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="password" class="form__label--item">確認用パスワード</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="password" id="password_confirmation" name="password_confirmation" />
                    </div>
                    <div class="form__error">
                        @error('password_confirmation')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__footer">
                <button class="form__footer-button" type="submit">登録する</button>
                <a href="/login" class="form__footer-link">ログインはこちら</a>
            </div>
        </form>
    </div>
</div>

@endsection
