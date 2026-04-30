<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <a href="{{ route('products.index') }}" class="header__logo" style="text-decoration:none;">
            mogitate
        </a>
    </header>
    <div id="app">
        <main class="main">
            @yield('content')
        </main>
    </div>


</body>

</html>