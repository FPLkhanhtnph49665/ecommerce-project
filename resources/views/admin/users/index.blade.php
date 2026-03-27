@extends('layouts.admin')

@section('title', 'Quản lý User')

@section('content')
    <h1 class="mb-4">Danh sách User</h1>

    {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">+ Thêm User</a>
    <a href="{{ route('admin.users.trashed') }}" class="btn btn-secondary mb-3">Thùng rác</a> --}}

    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->role === 'admin')
                            Quản trị viên
                        @elseif($user->role === 'customer')
                            Người dùng
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">Xem</a>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Xóa user này?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Không có user nào</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
@endsection
