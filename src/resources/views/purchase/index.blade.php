@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/index.css') }}" />
@endsection

@section('content')
<div class="order-page">
    <div class="order-detail">
        <div class="item">
            <img src="{{ asset('products/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="item-image">
            <div class="item-detail">
                <h2 class="item-name">{{ $item->item_name }}</h2>
                <div class="item-price">
                    <span class="yen">¥</span>
                    <span class="price">{{ number_format($item->price) }}</span>
                </div>
            </div>
        </div>

        <div class="payment-method">
            <h3 class="payment-method__title">支払い方法</h3>
            <div class="payment-method__select">
                <div class="payment-method__text">
                    <select class="payment-method-select form__select-input">
                        <option value="" disabled selected>選択してください</option>
                        <option value="convenience_store">コンビニ払い</option>
                        <option value="card">カード払い</option>
                    </select>
                </div>
                <div class="form__error">
                    @error('payment_method')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="address">
            <div class="address__title">
                <h3 class="address__title-name">配送先</h3>
                <a href="{{ route('purchase.address', $item->id) }}" class="address__title-change">変更する</a>
            </div>
            <div class="address-detail">
                @php
                    $address = $user->address ?? $user->profile;
                    $profileEmpty = empty($address->postcode) && empty($address->address);
                @endphp
                <input type="hidden" name="address" value="{{ $profileEmpty ? '' : trim(($address->postcode ?? '') . ' ' . ($address->address ?? '') . ' ' . ($address->building ?? '')) }}">
                <p class="address-detail__text">〒 {{ $address->postcode }}</p>
                <p class="address-detail__text">{{ $address->address }}{{ $address->building }}</p>
                <div class="form__error">
                    @error('address')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="order-info">
        <ul class="order-summary">
            <li class="order-row">
                <span class="label">商品代金</span>
                <span class="price-wrap">
                    <span class="yen">¥</span>
                    <span class="price">{{ number_format($item->price) }}</span>
                </span>
            </li>
            <li class="order-row">
                <span class="label">支払い方法</span>
                <span class="payment-method-display value"></span>
            </li>
        </ul>

        <div class="order-button">
            <form action="{{ route('purchase.store', ['item_id' => $item->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" class="payment-method-hidden" name="payment_method">
                <input type="hidden" name="address" value="{{ $profileEmpty ? '' : trim(($address->postcode ?? '') . ' ' . ($address->address ?? '') . ' ' . ($address->building ?? '')) }}">
                <button type="submit" class="order-button-submit">購入する</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const select = document.querySelector('.payment-method-select');
    const display = document.querySelector('.payment-method-display');
    const hidden = document.querySelector('.payment-method-hidden');

    display.textContent = '';
    hidden.value = '';

    select.addEventListener('change', function () {
        if (select.value === 'convenience_store') {
            display.textContent = 'コンビニ払い';
            hidden.value = 'convenience_store';
        } else if (select.value === 'card') {
            display.textContent = 'カード払い';
            hidden.value = 'card';
        }
    });
});
</script>

@endsection
