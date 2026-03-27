@extends('layouts.admin')

@section('title', 'Thêm Biến thể Sản phẩm')

@section('content')
<h1 class="mb-4">Thêm Biến thể Mới</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.variants.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label class="form-label">Sản phẩm</label>
        <select name="product_id" class="form-control" required>
            <option value="">-- Chọn sản phẩm --</option>
            @foreach($products as $product)
            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Màu sắc</label>
        <input type="text" name="color" class="form-control" value="{{ old('color') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Size</label>
        <input type="text" name="size" class="form-control" value="{{ old('size') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Giá</label>
        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Giá khuyến mãi (nếu có)</label>
        <input type="number" name="sale_price" class="form-control" value="{{ old('sale_price') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Tồn kho</label>
        <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Hình ảnh</label>
        <input type="text" name="image" class="form-control" value="{{ old('image') }}">
    </div>

    <button type="submit" class="btn btn-success">Lưu</button>
    <a href="{{ route('admin.variants.index') }}" class="btn btn-secondary">Hủy</a>
</form>
@endsection
