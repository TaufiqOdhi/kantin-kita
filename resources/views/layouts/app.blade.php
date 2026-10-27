<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Kantin Kita')</title>
    <link rel="stylesheet" href="{{ asset('css/kantin.css') }}">
    <script src="{{ asset('js/kantin.js') }}" defer></script>
</head>
<body>
<header>
    <a class="brand" href="{{ route('katalog') }}">Kantin Kita</a>
    <nav aria-label="Navigasi utama">
        <a href="{{ route('katalog') }}">Katalog</a>
        <a href="{{ route('produk.index') }}">Kelola produk</a>
    </nav>
</header>
<main>
    @if(session('success'))
        <p class="notice" role="status">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p class="error" role="alert">{{ session('error') }}</p>
    @endif
    @yield('content')
</main>
<footer>Kantin sekolah · MAKN Ende</footer>
</body>
</html>
