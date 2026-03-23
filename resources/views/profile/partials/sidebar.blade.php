<div class="bg-dark text-white p-3 d-flex flex-column" style="width:250px; min-height:100vh;">

    <h4 class="mb-4">Admin Panel</h4>

    <ul class="nav nav-pills flex-column gap-2">

        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : '' }}">
                📊 Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.products.index') }}"
               class="nav-link text-white {{ request()->routeIs('admin.products.*') ? 'active bg-primary' : '' }}">
                📦 Products
            </a>
        </li>

        <li>
            {{-- <a href="{{ route('admin.categories.index') }}"
               class="nav-link text-white {{ request()->routeIs('admin.categories.*') ? 'active bg-primary' : '' }}">
                🗂 Categories
            </a> --}}
        </li>

        <li>
            {{-- <a href="{{ route('admin.orders.index') }}"
               class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'active bg-primary' : '' }}">
                🧾 Orders
            </a> --}}
        </li>

        <li>
            <a href="#"
               class="nav-link text-white">
                👥 Customers
            </a>
        </li>

    </ul>

    <hr class="text-secondary">

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger w-100">
            🚪 Logout
        </button>
    </form>

</div>
