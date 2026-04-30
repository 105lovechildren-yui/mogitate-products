@extends('layout.app')

@section('title', $product->name . ' | 商品詳細')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="title-area">
    <div class="title-area__title" style="margin: 0 auto 0 0; text-align: left;">
        <a href="{{ route('products.index') }}" class="detail-title-link">商品一覧</a> &gt; {{ $product->name }}
    </div>
</div>
<form method="POST" action="{{ route('products.update', ['productId' => $product->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="detail-wrapper">
        <div class="detail__image-wrapper">
            {{-- 現在の画像を表示 (FN013-1) --}}
            <img src="{{ asset('storage/fruits-img/' . $product->image) }}" alt="{{ $product->name }}" class="detail__image">

            {{-- ファイル選択エリア --}}
            <label class="detail__file-label">
                <input type="file" name="image" class="detail__file-input" style="display:none;"
                    onchange="document.getElementById('file-name').textContent = this.files ? this.files[0].name : '{{ $product->image }}';">

                <span class="detail__file-button">ファイルを選択</span>
                <span id="file-name" class="detail__file-name">{{ $product->image }}</span>
            </label>
            @error('image')
            <p style="color:red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="detail__form-wrapper">
            <div class="detail__form-group">
                <label for="name">商品名</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}">
                @error('name')
                <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="detail__form-group">
                <label for="price">値段</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}">
                @error('price')
                <p style="color:red;">{{ $message }}</p>
                @enderror
            </div>
            <div class="detail__form-group">
                <label>季節</label>
                <div class="season-radio-group">
                    @foreach($seasons as $season)
                    <label class="season-radio-label">
                        <input type="checkbox" name="seasons[]" value="{{ $season->id }}"
                            {{ $product->seasons->contains($season->id) ? 'checked' : '' }}>
                        <span>{{ $season->name }}</span>
                    </label>
                    @error('seasons')
                    <p style="color:red;">{{ $message }}</p>
                    @enderror
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="detail__desc-wrapper">
        <label for="description">商品説明</label>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
        @error('description')
        <p style="color:red;">{{ $message }}</p>
        @enderror
    </div>

    <div class="detail__button-row">
        <div class="detail__button-group detail__button-group--center">
            <a href="{{ route('products.index') }}" class="detail__button detail__button--secondary">戻る</a>
            <button type="submit" class="detail__button detail__button--primary">変更を保存</button>
        </div>

    </div>
</form>
<div class="detail__button-group detail__button-group--right">
    <form method="POST" action="{{ route('products.destroy', ['productId' => $product->id]) }}" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit"
            onclick="return confirm('本当に削除しますか？');"
            class="detail__button detail__button--danger"
            title="削除">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6l-2 14H7L5 6"></path>
                <path d="M10 11v6"></path>
                <path d="M14 11v6"></path>
                <path d="M9 6V4h6v2"></path>
            </svg>
        </button>
    </form>
</div>

@endsection