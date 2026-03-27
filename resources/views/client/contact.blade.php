@extends('layouts.client')

@section('title', 'Liên hệ')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 fw-bold">📩 Liên hệ với chúng tôi</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('contact.store') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" value="{{ old('name') }}">
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror"
                   id="email" name="email" value="{{ old('email') }}">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <label for="subject" class="form-label">Chủ đề</label>
            <input type="text" class="form-control @error('subject') is-invalid @enderror"
                   id="subject" name="subject" value="{{ old('subject') }}">
            @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <label for="message" class="form-label">Nội dung</label>
            <textarea class="form-control @error('message') is-invalid @enderror"
                      id="message" name="message" rows="5">{{ old('message') }}</textarea>
            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-primary">Gửi liên hệ</button>
        </div>
    </form>
</div>
@endsection
