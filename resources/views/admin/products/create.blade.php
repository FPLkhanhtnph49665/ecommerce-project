@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
<h1 class="mb-4">Thêm sản phẩm mới</h1>

<a href="{{ route('admin.products.index') }}" class="btn btn-secondary mb-3">← Quay lại</a>

@if($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Tên sản phẩm</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}" required>
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Danh mục</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">-- Chọn danh mục --</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Giá</label>
        <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" required>
    </div>

    <div class="mb-3">
        <label for="sale_price" class="form-label">Giá khuyến mãi</label>
        <input type="number" name="sale_price" id="sale_price" class="form-control" value="{{ old('sale_price') }}">
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Tồn kho</label>
        <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}">
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Ảnh sản phẩm</label>
        <input type="file" name="image" id="image" class="form-control">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Mô tả</label>
        <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
</form>
@endsection
