@extends('layout.app')


@section('title', '商品一覧')


@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="title-area">
    <div class="title-area__title">商品一覧</div>
    <a href="#" class="title-area__button">商品を追加</a>
</div>
<div class="content-wrapper">
    <aside class="sidebar">
        <form action="{{ route('products.index') }}" method="GET" class="sidebar__form">
            <input type="text" name="keyword" class="sidebar__input" placeholder="商品名で検索" value="{{ request('keyword') }}">
            <button type="submit" class="sidebar__search-button">検索</button>

            <div class="sidebar__section-title">価格順で表示</div>
            <select name="sort" class="sidebar__select">
                <option value="" selected>価格で並べ替え</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
            </select>
        </form>
    </aside>

    <main class="main">
        @if(request('sort'))
        <div class="sort-status">
            <span>
                {{ request('sort') == 'asc' ? '低い順に表示' : '高い順に表示' }}
            </span>
            <a href="{{ route('products.index', ['keyword' => request('keyword')]) }}" class="sort-status__reset">×</a>
        </div>
        @endif
        <div class="main__grid">
            @foreach($products as $product)
            <div class="main__item">
                <img src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="{{ $product->name }}" class="main__item-image">
                <div class="main__item-details">
                    <div class="main__item-title">{{ $product->name }}</div>
                    <div class="main__item-price">￥{{ number_format($product->price) }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    </main>
    
</div>
@endsection