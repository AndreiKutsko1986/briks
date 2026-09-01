<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bricks Catalog') | Bricks Catalog</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="{{ route('home') }}" class="logo">
                <span class="logo-icon">🧱</span>
                <span class="logo-text">Bricks Catalog</span>
            </a>
            <form class="search-form" action="{{ route('catalog') }}" method="get">
                <input type="search" name="q" placeholder="Search parts, sets, minifigures..." value="{{ $searchQuery ?? '' }}">
                <button type="submit">Search</button>
            </form>
            <nav class="main-nav">
                <a href="{{ route('catalog', ['category' => 'parts']) }}">Parts</a>
                <a href="{{ route('catalog', ['category' => 'sets']) }}">Sets</a>
                <a href="{{ route('catalog', ['category' => 'minifigures']) }}">Minifigures</a>
                <a href="{{ route('catalog', ['category' => 'gear']) }}">Gear</a>
                <a href="{{ route('admin.login') }}" class="admin-link">Admin</a>
            </nav>
        </div>
    </header>
    <main class="site-main">
        @yield('content')
    </main>
    <footer class="site-footer">
        <div class="container">
            <p>&copy; {{ date('Y') }} Bricks Catalog — LEGO parts marketplace demo</p>
        </div>
    </footer>
</body>
</html>
