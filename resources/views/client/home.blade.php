@extends('layouts.client')

@section('title', 'Trang chủ')

@section('content')

    <!-- 🔥 HERO BANNER -->
    <div class="bg-dark text-white p-5 mb-5 rounded">
        <div class="container text-center text-md-start">
            <h1 class="display-5 fw-bold">Chào mừng đến với E-Commerce</h1>
            <p class="lead">Nơi mua sắm uy tín – Giá tốt – Giao hàng nhanh</p>
            <a href="{{ route('products.index') }}" class="btn btn-warning btn-lg mt-3">
                Mua sắm ngay
            </a>
        </div>
    </div>

    <!-- 🛍️ SẢN PHẨM MỚI -->
    <div class="container mb-5">
        <h2 class="mb-4 fw-bold">🔥 Sản phẩm mới</h2>

        <div class="row g-4">
            @forelse($latestProducts as $product)
                <div class="col-6 col-md-3">
                    <div class="card h-100 shadow-sm border-0">

                        <!-- ẢNH -->
                        <div class="position-relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                     style="height:220px; object-fit:cover;">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" class="card-img-top"
                                     style="height:220px; object-fit:cover;">
                            @endif

                            <!-- BADGE SALE -->
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                    SALE
                                </span>
                            @endif

                            <!-- HẾT HÀNG -->
                            @if($product->stock == 0)
                                <span class="badge bg-secondary position-absolute top-0 end-0 m-2">
                                    Hết hàng
                                </span>
                            @endif
                        </div>

                        <!-- BODY -->
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title fw-semibold text-truncate">
                                {{ $product->name }}
                            </h6>

                            <!-- GIÁ -->
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <p class="mb-1">
                                    <span class="text-danger fw-bold fs-5">
                                        {{ number_format($product->sale_price, 0, ',', '.') }} đ
                                    </span>
                                    <br>
                                    <small class="text-muted text-decoration-line-through">
                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                    </small>
                                </p>
                            @else
                                <p class="text-danger fw-bold fs-5 mb-1">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </p>
                            @endif

                            <!-- TRẠNG THÁI -->
                            @if($product->stock > 0)
                                <span class="badge bg-success mb-2">Còn hàng</span>
                            @else
                                <button class="btn btn-secondary btn-sm w-50 mb-2" disabled>
                                    Hết hàng
                                </button>
                            @endif

                            <!-- ACTION -->
                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="btn btn-outline-primary btn-sm w-50">
                                    Xem
                                </a>

                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-50">
                                        @csrf
                                        <button class="btn btn-success btn-sm w-100">
                                            Thêm vào giỏ
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Chưa có sản phẩm mới.</p>
                </div>
            @endforelse
        </div>

        <!-- XEM TẤT CẢ -->
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-dark">
                Xem tất cả sản phẩm
            </a>
        </div>
    </div>

    <!-- 📰 BÀI VIẾT MỚI (nếu muốn thêm) -->
    {{--
    <div class="container mb-5">
        <h2 class="mb-4 fw-bold">📰 Bài viết mới</h2>
        <!-- tương tự hiển thị bài viết -->
    </div>
    --}}

@endsection
