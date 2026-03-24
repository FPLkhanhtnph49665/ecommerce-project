<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <!-- 🔥 NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                E-Commerce
            </a>

            <!-- TOGGLE MOBILE -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse" id="navbarNav">

                <!-- LEFT MENU -->
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
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

                <!-- RIGHT MENU -->
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
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">

                                @if(Auth::user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            Admin
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item">Đăng xuất</button>
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

    <!-- 🔥 CONTENT -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- 🔥 FOOTER -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">
                © {{ date('Y') }} E-Commerce Project. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>
