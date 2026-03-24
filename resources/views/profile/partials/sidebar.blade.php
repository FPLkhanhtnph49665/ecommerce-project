<div class="d-flex flex-column bg-dark text-white p-3 shadow-lg"
     style="width:260px; min-height:100vh;">

    <!-- Logo -->
    <div class="mb-4 text-center">
        <h4 class="fw-bold">🚀 Admin Panel</h4>
        <small class="text-secondary">E-Commerce System</small>
    </div>

    <!-- Menu -->
    <ul class="nav nav-pills flex-column gap-2">

        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link d-flex align-items-center gap-2 text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary shadow-sm' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.categories.index') }}"
               class="nav-link d-flex align-items-center gap-2 text-white {{ request()->routeIs('admin.categories.*') ? 'active bg-primary shadow-sm' : '' }}">
                <i class="bi bi-folder"></i>
                <span>Danh mục</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.products.index') }}"
               class="nav-link d-flex align-items-center gap-2 text-white {{ request()->routeIs('admin.products.*') ? 'active bg-primary shadow-sm' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Sản phẩm</span>
            </a>
        </li>

        <li>
            <a href="{{ route('admin.orders.index') }}"
               class="nav-link d-flex align-items-center gap-2 text-white {{ request()->routeIs('admin.orders.*') ? 'active bg-primary shadow-sm' : '' }}">
                <i class="bi bi-receipt"></i>
                <span>Đơn hàng</span>
            </a>
        </li>

        <li>
            <a href="#"
               class="nav-link d-flex align-items-center gap-2 text-white">
                <i class="bi bi-people"></i>
                <span>Khách hàng</span>
            </a>
        </li>

    </ul>

    <!-- Spacer -->
    <div class="mt-auto">

        <hr class="text-secondary">

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-danger w-100 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </button>
        </form>

    </div>

</div>
