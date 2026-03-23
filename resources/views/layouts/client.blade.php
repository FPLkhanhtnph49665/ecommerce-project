<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce Project')</title>
    <!-- CSS Bootstrap (nếu dùng) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS tùy chỉnh -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <!-- Header / Navbar -->
    <header class="bg-dark text-white py-3">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="{{ route('home') }}" class="text-white text-decoration-none">
                <h2>E-Commerce</h2>
            </a>
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link text-white">Trang chủ</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Sản phẩm</a></li>
                    <li class="nav-item"><a href="#" class="nav-link text-white">Bài viết</a></li>
                    <li class="nav-item"><a href="{{ route('dangnhap') }}" class="nav-link text-white">Đăng nhập</a>
                    </li>
                    <li class="nav-item"><a href="{{ route('dangky') }}" class="nav-link text-white">Đăng ký</a></li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                            Logout
                        </button>
                    </form>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} E-Commerce Project. All rights reserved.</p>
        </div>
    </footer>

    <!-- JS Bootstrap (nếu dùng) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS tùy chỉnh -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
