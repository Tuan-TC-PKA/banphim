{{-- resources/views/components/navbar-logged-in.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Liên kết đến Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Liên kết đến Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <!-- Liên kết đến file CSS tùy chỉnh -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <!-- Nút toggle cho mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarContent" aria-controls="navbarContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Logo -->
            <a href="/" class="navbar-brand">DROP</a>

            <!-- Các icon luôn hiển thị -->
            <div class="d-flex align-items-center order-lg-2 ms-auto"> {{-- Đã sửa thành ms-auto --}}
                <span class="search-icon fas fa-search mx-2"></span>
                <span class="nav-notification fas fa-bell mx-2"></span>
                <span class="nav-cart fas fa-shopping-cart mx-2"></span>
                <div class="dropdown ms-2">
                    <button class="btn nav-user-dropdown-trigger" type="button"
                            id="dropdownUserButton" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <span class="nav-user fas fa-user"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUserButton">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Nội dung navbar (các mục menu) -->
            <div class="collapse navbar-collapse order-lg-1 justify-content-center" id="navbarContent">
                <ul class="navbar-nav w-100 mb-2 mb-lg-0"> {{-- Đã thêm class w-100 vào đây --}}
                    <li class="nav-item"><a class="nav-link" href="#">WHAT'S NEW</a></li>
                    <li class="nav-item"><a class="nav-link" href="">SHOP</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">SALE</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">COMMUNITY</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Liên kết đến Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>