@extends('layouts.admin')

@section('title', 'Quản lý Biến thể Sản phẩm')

@section('content')

<h1 class="mb-4">Danh sách Biến thể Sản phẩm</h1>

<div class="mb-3">
    <a href="{{ route('admin.variants.create') }}" class="btn btn-primary">
        + Thêm biến thể mới
    </a>
</div>

<table class="table table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Sản phẩm</th>
            <th>Màu sắc</th>
            <th>Size</th>
            <th>Giá</th>
            <th>Tồn kho</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($variants as $variant)
        <tr>
            <td>{{ $variant->id }}</td>
            <td>{{ $variant->product->name ?? '—' }}</td>
            <td>{{ $variant->color }}</td>
            <td>{{ $variant->size }}</td>
            <td>{{ number_format($variant->price, 0, ',', '.') }} đ</td>
            <td>{{ $variant->stock }}</td>
            <td>
                <a href="{{ route('admin.variants.edit', $variant->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                <form action="{{ route('admin.variants.destroy', $variant->id) }}"
                      method="POST"
                      class="d-inline"
                      onsubmit="return confirm('Xóa biến thể này?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Không có biến thể nào</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $variants->links('pagination::bootstrap-5') }}
</div>

@endsection
