<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a class="header__logo" href="{{ url('/') }}">
                <img src="{{ asset('img/COACHTECHヘッダーロゴ.png') }}"  alt="coachtech">
            </a>
            <div class="header__search">
                <form class="search-form" action="{{ route('items.search') }}" method="get">
                    <input class="header__search-input" type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ request('keyword') }}">
                </form>
            </div>
            <div class="header__nav">
                <form class="logout-form" action="/logout" method="post" >
                    @csrf
                    <button type="submit" class="header__nav-logout">ログアウト</button>
                </form>
                <a href="/mypage" class="header__nav-mypage">マイページ</a>
                <a href="/sell" class="header__nav-sell">出品</a>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
@yield('scripts')
</body>
</html>