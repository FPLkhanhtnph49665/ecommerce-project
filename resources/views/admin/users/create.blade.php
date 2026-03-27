@extends('layouts.admin')

@section('title', 'Thêm User mới')

@section('content')
<h1 class="mb-4">Thêm User mới</h1>

<a href="{{ route('admin.users.index') }}" class="btn btn-secondary mb-3">← Quay lại danh sách</a>

<!-- Hiển thị lỗi validate -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <!-- Name -->
    <div class="mb-3">
        <label for="name" class="form-label">Tên User</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>

    <!-- Password Confirmation -->
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <!-- Role -->
    <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <select name="role" id="role" class="form-select" required>
            <option value="">-- Chọn Role --</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Tạo User</button>
</form>
@endsection
