<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="/css/sanitize.css">
    <link rel="stylesheet" href="/css/common.css">
</head>

<body>
    <header class="header">
        <div class="header__logo">mogitate</div>
    </header>
    <div id="app">
        <main class="main">
            @yield('content')
        </main>
    </div>

    
</body>

</html>