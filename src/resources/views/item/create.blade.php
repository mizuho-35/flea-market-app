@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/item/create.css') }}" />
@endsection

@section('content')
<div class="create-page">
    <h1 class="form__heading">商品の出品</h1>
    <div class="form__content">
        <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <label for="item_image" class="form__label--item">商品画像</label>
                </div>
                <div class="form__group-content item-image-area">
                    <div class="item-image-frame">
                        <div class="preview-wrapper">
                            <div class="preview-box"></div>
                        </div>
                        <label class="item-image-button">
                            画像を選択する
                            <input type="file" name="item_image" class="item-image-input" accept="image/*" hidden>
                        </label>
                    </div>
                </div>
                <div class="form__error">
                    @error('item_image')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form-title">
                <h2 class="form-title__name">商品の詳細</h2>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="category_list" class="form__label--item">カテゴリー</label>
                </div>
                <div class="category-list">
                    @foreach($categories as $category)
                        <label class="category-item">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }} >
                            <span>{{ $category->category_name }}</span>
                        </label>
                    @endforeach
                </div>
                <div class="form__error">
                    @error('categories')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="condition" class="form__label--item">商品の状態</label>
                </div>
                <div class="form__group-content">
                    <div class="condition__text">
                        <select name="condition" class="condition-select form__select-input">
                            <option value="" disabled selected>選択してください</option>
                            <option value="良好">良好</option>
                            <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                            <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                            <option value="状態が悪い">状態が悪い</option>
                        </select>
                    </div>
                    <div class="form__error">
                        @error('condition')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-title">
                <h2 class="form-title__name">商品名と説明</h2>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="item_name" class="form__label--item">商品名</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" id="item_name" name="item_name" value="{{ old('item_name') }}">
                    </div>
                    <div class="form__error">
                        @error('item_name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="brand" class="form__label--item">ブランド名</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" id="brand" name="brand" value="{{ old('brand') }}">
                    </div>
                    <div class="form__error">
                        @error('brand')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="description" class="form__label--item">商品の説明</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <textarea name="description" class="comment-input">{{ old('description') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('description')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <label for="price" class="form__label--item">販売価格</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--price">
                        <span class="yen-mark">¥</span>
                        <input type="text" id="price" name="price" value="{{ old('price') }}" />
                    </div>
                    <div class="form__error">
                        @error('price')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__footer">
                <button class="form__footer-button" type="submit">出品する</button>
            </div>
        </form>
    </div>

</div>
@endsection

@section('scripts')
<script>
document.querySelector('.item-image-input').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(event) {

        const frame = document.querySelector('.item-image-frame');
        const wrapper = document.querySelector('.preview-wrapper');
        const oldPreview = wrapper.querySelector('.preview-box, .preview-image');

        const img = document.createElement('img');
        img.src = event.target.result;
        img.classList.add('preview-image');
        oldPreview.replaceWith(img);

    };

    reader.readAsDataURL(file);
});
</script>

@endsection
