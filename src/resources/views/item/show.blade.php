@extends($layout)

@section('css')
<link rel="stylesheet" href="{{ asset('css/item/show.css') }}" />
@endsection

@section('content')
<div class="item-page">
    <img src="{{ file_exists(public_path('storage/' . $item->item_image)) ? asset('storage/' . $item->item_image) : asset('products/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="item-image" />
    <div class="item-detail">
        <h1 class="item-name">{{ $item->item_name }}</h1>
        <div class="item-brand">{{ $item->brand }}</div>
        <div class="item-price">
            <span class="yen">¥</span>
            <span class="price">{{ number_format($item->price) }}</span>
            <span class="tax">(税込)</span>
        </div>
        <div class="item-action">
            <div class="item-like">
                @if($isLiked)
                    <form action="{{ route('like.destroy') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button class="like-button">
                            <img src="/img/ハートロゴ_ピンク.png" class="like-icon">
                        </button>
                    </form>
                @else
                    <form action="{{ route('like.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        <button class="like-button">
                            <img src="/img/ハートロゴ_デフォルト.png" class="like-icon">
                        </button>
                    </form>
                @endif
                <div class="like-count">{{ $likeCount }}</div>
            </div>
            <div class="item-comment">
                <button class="comment-button">
                    <img src="/img/ふきだしロゴ.png" class="comment-icon">
                </button>
                <div class="comment-count">{{ $commentCount }}</div>
            </div>
        </div>
        <div class="order-button">
            @if ($item->user_id === auth()->id() || $item->status == 1)
                <div class="order-button-submit disabled">
                    購入手続きへ
                </div>
            @else
                <a href="{{ url('/purchase/' . $item->id) }}" class="order-button-submit">
                    購入手続きへ
                </a>
            @endif
        </div>
        <div class="item-description">
            <h2 class="item-description__title">商品説明</h2>
            <div class="item-description__text">{{ $item->description }}</div>
        </div>
        <div class="item-information">
            <h2 class="item-information__title">商品の情報</h2>
            @php
                $categoryIds = explode(',', $item->category_list);
                $categories = \App\Models\Category::whereIn('id', $categoryIds)->get();
            @endphp
            <div class="item-information__category">
                <span class="item-information__subtitle">カテゴリー</span>
                <div class="category-list">
                    @foreach($categories as $category)
                        <span class="category">{{ $category->category_name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="item-information__condition">
                <span class="item-information__subtitle">商品の状態</span>
                <span class="condition">{{ $item->condition }}</span>
            </div>
        </div>
        <div class="comment-space">
            <h2 class="comment-header">
                コメント（{{ $commentCount }}）
            </h2>
            <div class="comment-list">
                @foreach($comments as $comment)
                    <div class="comment__item">
                        <div class="comment__user-profile">
                            <div class="profile-image-preview">
                                @if($comment->user->profile && $comment->user->profile->profile_image)
                                    <img src="{{ asset('storage/' . $comment->user->profile->profile_image) }}" alt="プロフィール画像" class="profile-image">
                                @else
                                    <div class="profile-image-default"></div>
                                @endif
                            </div>
                            <div class="profile-username">
                                {{ $comment->user->username }}
                            </div>
                        </div>
                        <div class="comment__text">
                            {{ $comment->comment }}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="comment-page">
                <h3 class="comment-page-header">商品へのコメント</h3>
                <form action="{{ route('comment.store') }}" method="POST" class="comment-form" novalidate>
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <textarea name="comment" class="comment-input" required>{{ old('comment') }}</textarea>
                    <div class="form__error">
                        @error('comment')
                            {{ $message }}
                        @enderror
                    </div>
                    <button type="submit" class="comment-submit">コメントを送信する</button>
                </form>
            </div>
        </div>
    </div>


</div>



@endsection