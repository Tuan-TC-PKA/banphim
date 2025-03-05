{{-- resources/views/components/navbar-logged-in.blade.php --}}
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">
        <!-- Logo -->
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-logo" height="40">

        <!-- Toggle button for mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Các icon luôn hiển thị -->
        <div class="d-flex align-items-center order-lg-2 ms-auto">
            
            <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none">
                <span class="nav-cart fas fa-shopping-cart mx-2"></span>
            </a>
            <div class="dropdown ms-2">
                <button class="btn nav-user-dropdown-trigger" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="nav-user fas fa-user"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.ordersHistory') }}">Lịch sử mua hàng</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Menu items -->
        <div class="collapse navbar-collapse order-lg-1 justify-content-center" id="navbarContent">
            <ul class="navbar-nav w-100 mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.index') }}">SHOP</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Search Modal -->


<!-- Add JavaScript at the end of the file -->
<script>
const searchInput = document.getElementById('searchInput');
const searchResults = document.getElementById('searchResults');
let searchTimeout;

if (searchInput) {  // Add this check
  searchInput.addEventListener('input', function() {
    clearTimeout(searchTimeout);
    const query = this.value;

    searchTimeout = setTimeout(() => {
      if (query.length >= 2) {
        fetch(`/api/search?q=${encodeURIComponent(query)}`)
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(products => {
            if (products.length === 0) {
              searchResults.innerHTML = `
                <div class="list-group-item text-center text-muted">
                  <i class="fas fa-search mb-2"></i>
                  <p class="mb-0">Không tìm thấy sản phẩm nào</p>
                </div>
              `;
            } else {
              searchResults.innerHTML = products.map(product => `
                <a href="/products/${product.id}" class="list-group-item list-group-item-action">
                  <div class="d-flex align-items-center">
                    <img src="/storage/${product.image}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                    <div>
                      <h6 class="mb-1">${product.name}</h6>
                      <small class="text-muted">${new Intl.NumberFormat('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                      }).format(product.price)}</small>
                    </div>
                  </div>
                </a>
              `).join('');
            }
          })
          .catch(error => {
            console.error('Error:', error);
            searchResults.innerHTML = `
              <div class="list-group-item text-center text-muted">
                <p class="mb-0">Đã xảy ra lỗi khi tìm kiếm</p>
              </div>
            `;
          });
      } else {
        searchResults.innerHTML = '';
      }
    }, 300);
  });
}
</script>