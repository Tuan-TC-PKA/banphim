<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('build/assets/css/navbar.css') }}">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <!-- Nút toggle (bên trái logo) -->
        <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarContent" aria-controls="navbarContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo -->
        <a href="/" class="navbar-brand">DROP</a>

        <!-- Phần bên phải: icon, login, signup -->
        <div class="d-flex align-items-center order-lg-2 ms-auto">
            <span class="search-icon fas fa-search mx-2"></span>
            <a href="{{ route('login') }}" class="btn nav-login-btn mx-2">LOG IN</a>
            <a href="{{ route('register') }}" class="btn nav-signup-btn mx-2">SIGN UP</a>
        </div>

        <!-- Mục menu chính -->
        <div class="collapse navbar-collapse order-lg-1" id="navbarContent">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="#">WHAT'S NEW</a></li>
                <li class="nav-item"><a class="nav-link" href="#">SHOP</a></li>
                <li class="nav-item"><a class="nav-link" href="#">SALE</a></li>
                <li class="nav-item"><a class="nav-link" href="#">COMMUNITY</a></li>
            </ul>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
