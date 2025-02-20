{{-- resources/views/components/navbar-logged-in.blade.php --}}
<link rel="stylesheet" href="{{ asset('build/assets/css/navbar.css') }}">
<script src="{{ asset('build/assets/js/navbar.js') }}" defer></script>
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
            <a href="#" class="nav-rewards">
                <span>$0</span>
                <span>Rewards</span>
            </a>
            <span class="nav-notification"></span>
            <span class="nav-cart"></span>

            <div class="nav-user-dropdown">
                <button class="nav-user-dropdown-trigger" id="dropdownUserButton" data-dropdown-toggle="user-dropdown" aria-expanded="false">
                    <span class="nav-user"></span>
                </button>

                <div class="nav-user-dropdown-menu" aria-labelledby="dropdownUserButton">
                    <a href="{{ route('profile.edit') }}" class="nav-dropdown-item">
                        {{ __('Profile') }}
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-dropdown-item">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>