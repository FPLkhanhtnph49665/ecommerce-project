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
    <footer class="bg-dark text-white py-3">
        <div class="container text-center">
            <p class="mb-0 small">
                © {{ date('Y') }} Ất Dậu E-Commerce Project. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('scripts')

</body>
</html>
