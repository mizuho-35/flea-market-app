@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/purchase/address.css') }}" />
@endsection

@section('content')
@php
    $address = $user->profile;
@endphp
<div class="address-page">
    <h1 class="form__heading">住所の変更</h1>
    <div class="form__content">
        <form class="form" action="{{ route('purchase.address.update', $item->id) }}" method="post" novalidate>
            @csrf
            <input type="hidden" name="payment_method" value="{{ $payment_method }}">
            <div class="form__group">
                <div class="form__group-title">
                    <label for="postcode" class="form__label--item">郵便番号</label>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" id="postcode" name="postcode"
                            value="{{ old('postcode', $address->postcode) }}" />
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
                        <input type="text" id="address" name="address"
                            value="{{ old('address', $address->address) }}" />
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
                        <input type="text" id="building" name="building"
                            value="{{ old('building', $address->building) }}" />
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