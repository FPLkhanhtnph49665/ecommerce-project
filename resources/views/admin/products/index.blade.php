@extends('layouts.admin')

@section('title', 'Quản lý Sản phẩm')

@section('content')
<h1>Quản lý Sản phẩm</h1>

<div class="mb-3">
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Thêm sản phẩm mới</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Giá</th>
            <th>Giá KM</th>
            <th>Số lượng</th>
            <th>Hình ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? '—' }}</td>
            <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
            <td>{{ $product->sale_price ? number_format($product->sale_price, 0, ',', '.') : '-' }} VND</td>
            <td>{{ $product->stock }}</td>
            <td>
                @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="60">
                @else
                —
                @endif
            </td>
            <td>
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa không?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Chưa có sản phẩm nào.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $products->links() }}
</div>
@endsection
