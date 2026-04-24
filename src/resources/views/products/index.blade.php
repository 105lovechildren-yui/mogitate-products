@extends('layout.app')

@section('content')
<div class="title-area">
    <div class="title-area__title">商品一覧</div>
    <a href="#" class="title-area__button">商品を追加</a>
</div>
<div class="content-wrapper">
    <aside class="sidebar">
        <input type="text" class="sidebar__input" placeholder="商品名で検索">
        <button class="sidebar__search">検索</button>
        <div class="sidebar__section-title">価格で表示</div>
        <select class="sidebar__select">
            <option value="">すべて</option>
            <option value="1000">〜1,000円</option>
            <option value="3000">1,001〜3,000円</option>
            <option value="5000">3,001〜5,000円</option>
            <option value="5001">5,001円〜</option>
        </select>
    </aside>
    <main class="main">
        <div class="main__grid">
            @foreach($products as $product)
            <div class="main__item">
                <div class="main__item-title">{{ $product->name }}</div>
                <div class="main__item-price">{{ number_format($product->price) }}円</div>
            </div>
            @endforeach
        </div>
    </main>
</div>
@endsection