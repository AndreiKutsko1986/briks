<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') | Bricks Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">
    @auth
    <aside class="admin-sidebar">
        <div class="sidebar-brand">🧱 Bricks Admin</div>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('admin.items.index') }}" class="{{ request()->routeIs('admin.items.*') ? 'active' : '' }}">Items</a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
            <a href="{{ route('admin.listings.index') }}" class="{{ request()->routeIs('admin.listings.*') ? 'active' : '' }}">Listings</a>
            <a href="{{ route('home') }}" target="_blank">View Site</a>
            <form action="{{ route('admin.logout') }}" method="post" style="display:inline">
                @csrf
                <button type="submit" class="link-btn" style="display:block;width:100%;text-align:left;padding:0.6rem 1.25rem;background:none;border:none;color:#94a3b8;cursor:pointer;">Logout</button>
            </form>
        </nav>
        <div class="sidebar-user">{{ auth()->user()->name }}</div>
    </aside>
    @endauth
    <div class="admin-content">
        @if(session('success'))
            <div class="flash flash-success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
