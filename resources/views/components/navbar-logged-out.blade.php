<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}?v={{ time() }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <a href="/" class="navbar-brand">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-logo" height="40">
        </a>

        <!-- Menu items (always visible) -->
        <div class="d-flex justify-content-center flex-grow-1">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.index') }}">SHOP</a></li>
            </ul>
        </div>

        <!-- Login/Register buttons -->
        <div class="d-flex align-items-center ms-auto">
            <a href="{{ route('login') }}" class="btn nav-login-btn mx-2">LOG IN</a>
            <a href="{{ route('register') }}" class="btn nav-signup-btn mx-2">SIGN UP</a>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
