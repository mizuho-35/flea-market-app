@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile/index.css') }}" />
@endsection

@section('content')
<div class="profile-page">
    <div class="profile">
        <div class="profile__content">
            <div class="profile-image-preview">
                @if ($profile && $profile->profile_image)
                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="プロフィール画像" class="profile__image">
                @else
                    <div class="profile-image-default"></div>
                @endif
            </div>
            <h2 class="profile__username">{{ $user->username }}</h2>
        </div>
        <div class="profile__edit">
            <a href="{{ route('profile.edit') }}" class="profile__edit-button">プロフィールを編集</a>
        </div>
    </div>
    <div class="item-tabs">
        <a href="{{ route('profile.index', ['tab' => 'selling']) }}" class="{{ request('tab') !== 'purchased' ? 'active' : '' }}">出品した商品</a>
        <a href="{{ route('profile.index', ['tab' => 'purchased']) }}" class="{{ request('tab') === 'purchased' ? 'active' : '' }}">購入した商品</a>
    </div>
    <div class="item-list">
        @if (request('tab') !== 'purchased')
            @foreach($sellingItems as $item)
                <div class="item-card-wrapper">
                    @if ($item->status == 1)
                        <a href="{{ url('/item/' . $item->id) }}" class="item-card">
                            <div class="sold-badge">SOLD</div>
                            <img src="{{ asset('storage/products/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="item-image">
                            <div class="item-name">{{ $item->item_name }}</div>
                        </a>
                    @else
                        <a href="{{ url('/item/' . $item->id) }}" class="item-card">
                            <img src="{{ asset('storage/products/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="item-image">
                            <div class="item-name">{{ $item->item_name }}</div>
                        </a>
                    @endif
                </div>
            @endforeach
        @endif
        @if (request('tab') === 'purchased')
            @foreach($purchasedItems as $item)
                <div class="item-card-wrapper">
                    @if ($item->status == 1)
                        <a href="{{ url('/item/' . $item->id) }}" class="item-card">
                            <div class="sold-badge">SOLD</div>
                            <img src="{{ asset('storage/products/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="item-image">
                            <div class="item-name">{{ $item->item_name }}</div>
                        </a>
                    @else
                        <a href="{{ url('/item/' . $item->id) }}" class="item-card">
                            <img src="{{ asset('storage/products/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="item-image">
                            <div class="item-name">{{ $item->item_name }}</div>
                        </a>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
