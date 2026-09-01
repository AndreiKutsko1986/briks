<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Bricks</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="login-page">
    <form class="login-form" method="post" action="{{ route('admin.login') }}">
        @csrf
        <h1>🧱 Bricks Admin</h1>
        @if($errors->any())
            <div class="flash flash-error">{{ $errors->first() }}</div>
        @endif
        <label>Email<input type="email" name="email" required value="admin@bricks.local"></label>
        <label>Password<input type="password" name="password" required></label>
        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
        <p class="login-hint">Default: admin@bricks.local / admin123</p>
    </form>
</div>
</body>
</html>
