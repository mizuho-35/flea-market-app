@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}" />
@endsection

@section('content')

<div class="login-page">
    <h1 class="form__heading">ログイン</h1>
    <div class="form__content">
        <form class="form" action="{{ route('login.submit') }}" method="post" novalidate>
            @csrf
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
            <div class="form__footer">
                <button class="form__footer-button" type="submit">ログインする</button>
                <a href="/register" class="form__footer-link">会員登録はこちら</a>
            </div>
        </form>
    </div>
</div>

@endsection
