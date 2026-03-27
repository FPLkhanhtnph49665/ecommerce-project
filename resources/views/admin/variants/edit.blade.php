@extends('layouts.admin')

@section('title', 'Sửa Biến thể Sản phẩm')

@section('content')
<h1 class="mb-4">Sửa Biến thể</h1>

<form action="{{ route('admin.variants.update', $variant->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="product_id" class="form-label">Sản phẩm</label>
        <select name="product_id" class="form-control" required>
            <option value="">-- Chọn sản phẩm --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" {{ $variant->product_id == $product->id ? 'selected' : '' }}>
                    {{ $product->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="color" class="form-label">Màu sắc</label>
        <input type="text" name="color" class="form-control" value="{{ $variant->color }}" required>
    </div>

    <div class="mb-3">
        <label for="size" class="form-label">Size</label>
        <input type="text" name="size" class="form-control" value="{{ $variant->size }}" required>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" name="price" class="form-control" value="{{ $variant->price }}" required>
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Tồn kho</label>
        <input type="number" name="stock" class="form-control" value="{{ $variant->stock }}" required>
    </div>

    <button type="submit" class="btn btn-success">Cập nhật</button>
    <a href="{{ route('admin.variants.index') }}" class="btn btn-secondary">Hủy</a>
</form>
@endsection
