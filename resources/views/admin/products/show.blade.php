@extends('layouts.admin')

@section('title', 'Chi tiết sản phẩm')

@section('content')

    <h2 class="mb-4">📦 Chi tiết sản phẩm</h2>

    <div class="card mb-4">
        <div class="card-body">

            <div class="row">

                <!-- IMAGE -->
                <div class="col-md-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded shadow-sm">
                    @else
                        <div class="bg-light text-center p-5">Không có ảnh</div>
                    @endif
                </div>

                <!-- INFO -->
                <div class="col-md-8">

                    <h4 class="fw-bold">{{ $product->name }}</h4>

                    <p><strong>Danh mục:</strong> {{ $product->category->name ?? '—' }}</p>

                    <p>
                        <strong>Giá:</strong>
                        <span class="text-danger fw-bold">
                            {{ number_format($product->price, 0, ',', '.') }} đ
                        </span>
                    </p>

                    <p>
                        <strong>Giá khuyến mãi:</strong>
                        @if($product->sale_price)
                            <span class="text-success fw-bold">
                                {{ number_format($product->sale_price, 0, ',', '.') }} đ
                            </span>
                        @else
                            —
                        @endif
                    </p>

                    <p>
                        <strong>Tổng kho:</strong>
                        <span class="badge bg-primary">
                            {{ $product->variants->sum('stock') }}
                        </span>
                    </p>

                    <p>
                        <strong>Trạng thái:</strong>
                        @if($product->stock > 0)
                            <span class="badge bg-success">Còn hàng</span>
                        @else
                            <span class="badge bg-danger">Hết hàng</span>
                        @endif
                    </p>

                    <p>
                        <strong>Mô tả:</strong><br>
                        {{ $product->description }}
                    </p>

                    <div class="mt-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                            ⬅ Quay lại
                        </a>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                            ✏️ Sửa
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- 🔥 VARIANTS -->
    @if($product->variants->count() > 0)

        <div class="card">
            <div class="card-header fw-bold">
                🎯 Danh sách biến thể
            </div>

            <div class="card-body p-0">

                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>SKU</th>
                            <th>Màu</th>
                            <th>Size</th>
                            <th>Giá</th>
                            <th>Giá KM</th>
                            <th>Kho</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($product->variants as $variant)
                            <tr>
                                <td>{{ $variant->id }}</td>

                                <td>{{ $variant->sku }}</td>

                                <td>
                                    <span class="badge bg-dark">
                                        {{ $variant->color }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-primary">
                                        {{ $variant->size }}
                                    </span>
                                </td>

                                <td>
                                    {{ number_format($variant->price, 0, ',', '.') }} đ
                                </td>

                                <td>
                                    @if($variant->sale_price)
                                        {{ number_format($variant->sale_price, 0, ',', '.') }} đ
                                    @else
                                        —
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $variant->stock }}
                                    </span>
                                </td>

                                <td>
                                    @if($variant->stock > 0)
                                        <span class="badge bg-success">Còn</span>
                                    @else
                                        <span class="badge bg-danger">Hết</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

            </div>
        </div>

    @endif

@endsection
