@extends('layouts.admin')

@section('title', 'Quản lý Sản phẩm')

@section('content')

<h1 class="mb-4">Quản lý Sản phẩm</h1>

<div class="mb-3">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        + Thêm sản phẩm
    </a>
</div>

<table class="table table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Variants</th>
            <th>Tồn kho</th>
            <th>Trạng thái</th>
            <th width="150">Hành động</th>
        </tr>
    </thead>

    <tbody>
        @forelse($products as $product)

        @php
            $totalStock = $product->variants->sum('stock');
            $variantCount = $product->variants->count();
        @endphp

        <tr>

            <!-- ID -->
            <td>{{ $product->id }}</td>

            <!-- PRODUCT -->
            <td class="d-flex align-items-center gap-2">

                <img src="{{ $product->image
                    ? asset('storage/'.$product->image)
                    : asset('images/placeholder.png') }}"
                    width="60"
                    class="rounded">

                <div>
                    <strong>{{ $product->name }}</strong>
                    <br>
                    <small class="text-muted">
                        {{ $variantCount }} biến thể
                    </small>
                </div>

            </td>

            <!-- CATEGORY -->
            <td>{{ $product->category->name ?? '—' }}</td>

            <!-- PRICE -->
            <td>
                @if($product->sale_price)
                    <span class="text-danger fw-bold">
                        {{ number_format($product->sale_price, 0, ',', '.') }} đ
                    </span>
                    <br>
                    <small class="text-muted text-decoration-line-through">
                        {{ number_format($product->price, 0, ',', '.') }} đ
                    </small>
                @else
                    <span class="text-danger fw-bold">
                        {{ number_format($product->price, 0, ',', '.') }} đ
                    </span>
                @endif
            </td>

            <!-- VARIANTS -->
            <td>
                @if($variantCount > 0)

                    <div class="d-flex flex-wrap gap-1">

                        @foreach($product->variants->take(4) as $v)
                            <span class="badge bg-light text-dark border">
                                {{ $v->color }} - {{ $v->size }}
                            </span>
                        @endforeach

                        @if($variantCount > 4)
                            <span class="badge bg-secondary">
                                +{{ $variantCount - 4 }}
                            </span>
                        @endif

                    </div>

                @else
                    —
                @endif
            </td>

            <!-- STOCK -->
            <td>
                @if($variantCount > 0)
                    <strong>{{ $totalStock }}</strong>
                    <br>
                    <small class="text-muted">tổng</small>
                @else
                    {{ $product->stock }}
                @endif
            </td>

            <!-- STATUS -->
            <td>
                @if(($variantCount > 0 && $totalStock > 0) || ($variantCount == 0 && $product->stock > 0))
                    <span class="badge bg-success">Còn hàng</span>
                @else
                    <span class="badge bg-danger">Hết hàng</span>
                @endif
            </td>

            <!-- ACTION -->
            <td>

                <a href="{{ route('admin.products.edit', $product->id) }}"
                   class="btn btn-sm btn-warning">
                    Sửa
                </a>
<a href="{{ route('admin.products.show', $product->id) }}"
                   class="btn btn-sm btn-warning">
                    Xem
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Xóa sản phẩm?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">
                        Xóa
                    </button>
                </form>

            </td>

        </tr>

        @empty
        <tr>
            <td colspan="8" class="text-center">
                Không có sản phẩm
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $products->links('pagination::bootstrap-5') }}
</div>

@endsection
