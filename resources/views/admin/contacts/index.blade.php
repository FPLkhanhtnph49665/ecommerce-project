@extends('layouts.admin')

@section('title', 'Quản lý Liên hệ')

@section('content')

<h1 class="mb-4">Danh sách Liên hệ</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Chủ đề</th>
            <th>Ngày gửi</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($contacts as $contact)
            <tr>
                <td>{{ $contact->id }}</td>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->subject }}</td>
                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn btn-sm btn-info">Xem</a>

                    <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Xóa liên hệ này?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Không có liên hệ nào</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $contacts->links('pagination::bootstrap-5') }}
</div>

@endsection
