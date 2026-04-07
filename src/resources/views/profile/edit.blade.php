@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile/edit.css') }}" />
@endsection

@section('content')
<div class="edit-page">
    <h1 class="form__heading">プロフィール設定</h1>
    <div class="form__content">
        <form class="form" action="{{ $mode === 'setup' ? route('profile.store') : route('profile.update') }}" method="post" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="form__group">
                <div class="form__group-content profile-image-area">
                    <div class="profile-image-preview">
                        @if($user->profile && $user->profile->profile_image)
                            <img id="preview-image"
                                src="{{ asset('storage/' . $user->profile->profile_image) }}"
                                alt="プロフィール画像">
                        @else
                            <div id="preview-image" class="profile-image-default"></div>
                        @endif
                    </div>
                    <div class="profile-image-select">
                        <label class="profile-image-button">
                            画像を選択する
                            <input type="file" name="profile_image" id="profile_image" accept="image/*" hidden>
                        </label>
                    </div>
                </div>
                <div class="form__error">
                    @error('profile_image')
                        {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="username" class="form__label--item">ユーザー名</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" />
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
                    <label for="postcode" class="form__label--item">郵便番号</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="postcode" id="postcode" name="postcode" value="{{ old('postcode', $mode === 'edit' ? $user->profile->postcode : '') }}" />
                    </div>
                    <div class="form__error">
                        @error('postcode')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="address" class="form__label--item">住所</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" id="address" name="address" value="{{ old('address', $mode === 'edit' ? $user->profile->address : '') }}" />
                    </div>
                    <div class="form__error">
                        @error('address')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="building" class="form__label--item">建物名</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" id="building" name="building" value="{{ old('building', $mode === 'edit' ? $user->profile->building : '') }}" />
                    </div>
                </div>
            </div>
            <div class="form__footer">
                <button class="form__footer-button" type="submit">更新する</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.getElementById('profile_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(event) {

        // 既存の preview を削除
        const preview = document.getElementById('preview-image');
        preview.remove();

        // 新しい img を作成
        const img = document.createElement('img');
        img.id = 'preview-image';
        img.src = event.target.result;
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.borderRadius = '50%';
        img.style.objectFit = 'cover';

        // プレビューエリアに追加
        document.querySelector('.profile-image-preview').appendChild(img);
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
