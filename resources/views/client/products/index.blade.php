@extends('layouts.client')

@section('content')

    <div class="container">

        <!-- TITLE + FILTER (basic) -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Danh sách sản phẩm</h2>

            <!-- Có thể mở rộng filter sau -->
            <select class="form-select w-auto">
                <option>Sắp xếp</option>
                <option>Giá tăng dần</option>
                <option>Giá giảm dần</option>
            </select>
        </div>

        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm border-0">

                        <!-- IMAGE -->
                        <div class="position-relative">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.png') }}"
                                class="card-img-top" style="height:220px; object-fit:cover;">

                            <!-- SALE -->
                            @if($product->sale_price)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                    SALE
                                </span>
                            @endif

                            <!-- OUT OF STOCK -->
                            @if($product->stock == 0)
                                <span class="badge bg-secondary position-absolute top-0 end-0 m-2">
                                    Hết hàng
                                </span>
                            @endif
                        </div>

                        <!-- BODY -->
                        <div class="card-body d-flex flex-column">

                            <h6 class="fw-semibold">
                                {{ $product->name }}
                            </h6>

                            <!-- PRICE -->
                            @if($product->sale_price)
                                <div>
                                    <span class="text-danger fw-bold fs-5">
                                        {{ number_format($product->sale_price, 0, ',', '.') }} đ
                                    </span>
                                    <br>
                                    <small class="text-muted text-decoration-line-through">
                                        {{ number_format($product->price, 0, ',', '.') }} đ
                                    </small>
                                </div>
                            @else
                                <p class="text-danger fw-bold fs-5">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </p>
                            @endif

                            <!-- STATUS -->
                            @if($product->stock > 0)
                                <span class="badge bg-success mb-2">Còn hàng</span>
                            @else
                                <span class="badge bg-danger mb-2">Hết hàng</span>
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
            @endforeach
        </div>

        <!-- PAGINATION -->
        <div class="d-flex justify-content-center">
            {{ $products->links() }}
        </div>

    </div>

@endsection
