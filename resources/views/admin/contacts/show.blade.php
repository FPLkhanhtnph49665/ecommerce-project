@extends('layouts.admin')

@section('title', 'Chi tiết Liên hệ')

@section('content')

<h1 class="mb-4">Chi tiết Liên hệ</h1>

<div class="card">
    <div class="card-body">
        <p><strong>Tên:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Chủ đề:</strong> {{ $contact->subject }}</p>
        <p><strong>Nội dung:</strong></p>
        <p>{{ $contact->message }}</p>
        <p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>

        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
</div>

@endsection
