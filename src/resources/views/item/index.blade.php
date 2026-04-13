@extends($layout)

@section('css')
<link rel="stylesheet" href="{{ asset('css/item/index.css') }}" />
@endsection

@section('content')
<div class="top-page">
    <div class="top-tabs">
        <a href="{{ route('items.index', ['keyword' => request('keyword')]) }}" class="{{ request('tab') !== 'mylist' ? 'active' : '' }}">
            おすすめ
        </a>
        <a href="{{ route('items.index', ['tab' => 'mylist', 'keyword' => request('keyword')]) }}" class="{{ request('tab') === 'mylist' ? 'active' : '' }}">
            マイリスト
        </a>
    </div>
    <div class="item-list">
        @foreach($items as $item)
        <div class="item-card-wrapper">
            @if ($item->status == 1)
                <a href="{{ url('/item/' . $item->id) }}" class="item-card sold">
                    <div class="sold-badge">SOLD</div>
                    <img src="{{ asset('products/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="item-image">
                    <div class="item-name">{{ $item->item_name }}</div>
                </a>
            @else
                <a href="{{ url('/item/' . $item->id) }}" class="item-card">
                    <img src="{{ asset('products/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="item-image">
                    <div class="item-name">{{ $item->item_name }}</div>
                </a>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
