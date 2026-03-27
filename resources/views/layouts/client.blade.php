<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ất Dậu E-Commerce')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- 🔥 NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                Ất Dậu E-Commerce
            </a>

            <!-- TOGGLE MOBILE -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- LEFT -->
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                           href="{{ route('home') }}">
                            Trang chủ
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"
                           href="{{ route('products.index') }}">
                            Sản phẩm
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Bài viết
                        </a>
                    </li>

                </ul>

                <!-- RIGHT -->
                <ul class="navbar-nav align-items-center">

                    <!-- CART -->
                    <li class="nav-item me-3">
                        <a href="{{ route('cart.index') }}" class="nav-link position-relative">
                            🛒
                            @if(cart_count() > 0)
                                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                                    {{ cart_count() }}
                                </span>
                            @endif
                        </a>
                    </li>

                    @auth
                        <!-- USER -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                               data-bs-toggle="dropdown">
                                👤 {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                                @if(Auth::user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            🛠 Quản trị viên
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">
                                        👤 Hồ sơ cá nhân
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        📦 Đơn hàng của tôi
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger">
                                            🚪 Đăng xuất
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </li>
                    @else
                        <!-- LOGIN -->
                        <li class="nav-item">
                            <a href="{{ route('dangnhap') }}" class="nav-link">
                                Đăng nhập
                            </a>
                        </li>
                    @endauth

                </ul>

            </div>
        </div>
    </nav>

    <!-- 🔥 CONTENT (QUAN TRỌNG) -->
    <main class="flex-grow-1 py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- 🔥 FOOTER -->
    <footer class="bg-dark text-white pt-5 pb-3">
    <div class="container">
        <div class="row">

            <!-- Logo / Tên shop -->
            <div class="col-md-4 mb-3 text-center text-md-start">
                <h5 class="fw-bold">Ất Dậu E-Commerce</h5>
                <p class="small">Nơi mua sắm uy tín – Giá tốt – Giao hàng nhanh</p>
            </div>

            <!-- Link nhanh -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Liên kết nhanh</h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Trang chủ</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-white text-decoration-none">Sản phẩm</a></li>
                    <li><a href="{{ route('contact') }}" class="text-white text-decoration-none">Liên hệ</a></li>
                </ul>
            </div>

            <!-- Liên hệ & mạng xã hội -->
            <div class="col-md-4 mb-3">
                <h6 class="fw-bold">Liên hệ</h6>
                <p class="small mb-1">Email: support@atudau.com</p>
                <p class="small mb-1">Hotline: 0123 456 789</p>
                <div class="d-flex gap-2">
                    <a href="#" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-5"><i class="bi bi-twitter"></i></a>
                </div>
            </div>

        </div>

        <hr class="bg-secondary">

        <!-- Copyright -->
        <div class="text-center small">
            © {{ date('Y') }} Ất Dậu E-Commerce Project. All rights reserved.
        </div>
    </div>
</footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

</body>
</html>
