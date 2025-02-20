{{-- resources/views/components/navbar-logged-out.blade.php --}}
<link rel="stylesheet" href="{{ asset('build/assets/css/navbar.css') }}">
<nav class="navbar">
    <div class="navbar-container">
        <a href="/" class="logo">DROP</a>
        <nav>
            <ul class="nav-menu">
                <li><a href="#">WHAT'S NEW</a></li>
                <li class="nav-menu li">
                     <a href="">SHOP</a>  {{-- Updated href to route('shop') --}}
                </li>
                <li><a href="#">SALE</a></li>
                <li><a href="#">COMMUNITY</a></li>
            </ul>
        </nav>
        <div class="nav-actions">
            <span class="search-icon"></span>
            <span class="nav-cart"></span>
            <a href="{{ route('login') }}" class="nav-login-btn">LOG IN</a>
            <a href="{{ route('register') }}" class="nav-signup-btn">SIGN UP</a>
        </div>
    </div>
</nav>