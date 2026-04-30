@extends('layout.app')

@section('title', '商品登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-title-area">
    <h2 class="register-title-area__title">商品登録</h2>
</div>
<div class="register-wrapper">
    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="register-form">
        @csrf
        <div class="register-form__group">
            <label for="name" class="register-form__label">商品名<span class="register-form__required">必須</span></label>
            <input type="text" id="name" name="name" class="register-form__input" placeholder="商品名を入力" value="{{ old('name') }}">
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="register-form__group">
            <label for="price" class="register-form__label">値段<span class="register-form__required">必須</span></label>
            <input type="number" id="price" name="price" class="register-form__input" placeholder="値段を入力" value="{{ old('price') }}">
            @error('price')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="register-form__group">
            <label class="register-form__label">商品画像<span class="register-form__required">必須</span></label>
            <div id="register-image-preview-area" style="margin-top: 12px; text-align: left;">
                <img id="register-image-preview" src="" alt="画像プレビュー" style="max-width: 100%; max-height: 200px; display: none; border-radius: 8px; border: 1px solid #eee;" />
            </div>
            <label class="register-form__file-label">
                <input type="file" name="image" id="register-file-input" class="register-form__file-input" accept="image/*" style="display:none;">
                <span class="register-form__file-button" id="register-file-button" tabindex="0">ファイルを選択</span>
                <span id="register-file-name" class="register-form__file-name"></span>
            </label>
            @error('image')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="register-form__group">
            <label class="register-form__label">季節<span class="register-form__required">必須</span></label>
            <div class="register-form__season-radio-group">
                @foreach($seasons as $season)
                <label>
                    <input type="checkbox" name="seasons[]" value="{{ $season->id }}" {{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
                    {{ $season->name }}
                </label>
                @endforeach
            </div>
            @error('seasons')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="register-form__group">
            <label for="description" class="register-form__label">商品説明<span class="register-form__required">必須</span></label>
            <textarea id="description" name="description" class="register-form__textarea" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
            @error('description')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div class="register-form__button-row">
            <a href="{{ route('products.index') }}" class="register-form__button register-form__button--secondary">戻る</a>
            <button type="submit" class="register-form__button register-form__button--primary">登録</button>
        </div>
    </form>
    <script>
        // ファイル選択ボタンでinput[type=file]を開き、画像プレビューも表示
        document.addEventListener('DOMContentLoaded', () => {
            const fileButton = document.getElementById('register-file-button');
            const fileInput = document.getElementById('register-file-input');
            const fileName = document.getElementById('register-file-name');
            const imagePreview = document.getElementById('register-image-preview');
            if (!fileButton || !fileInput || !fileName || !imagePreview) return;

            const openFileDialog = () => fileInput.click();
            fileButton.addEventListener('click', openFileDialog);
            fileButton.addEventListener('keydown', e => {
                if (e.key === 'Enter' || e.key === ' ') openFileDialog();
            });

            fileInput.addEventListener('change', () => {
                const file = fileInput.files[0];
                fileName.textContent = file ? file.name : '';
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '';
                    imagePreview.style.display = 'none';
                }
            });
        });
    </script>
</div>
@endsection