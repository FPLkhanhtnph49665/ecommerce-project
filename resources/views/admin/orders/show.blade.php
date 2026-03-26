@extends('layouts.admin')

@section('content')

<h3 class="mb-4">📄 Đơn hàng #{{ $order->id }}</h3>

<div class="card mb-4">
    <div class="card-body">

        <p><strong>Khách hàng:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>SĐT:</strong> {{ $order->phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
        <p><strong>Phương thức thanh toán:</strong> {{ ucfirst($order->payment_method) }}</p>
        <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

        <p>
            <strong>Trạng thái:</strong>
            @include('profile.partials.status', ['status' => $order->status])
        </p>

        <!-- Update status -->
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-3 d-flex align-items-center gap-2">
            @csrf

            <select name="status" class="form-select w-25">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Hủy</option>
            </select>

            <button class="btn btn-success">Cập nhật</button>
        </form>

        <!-- Confirm / Cancel buttons -->
        @if($order->status == 'pending')
            <div class="mt-3">
                <form action="{{ route('admin.orders.confirm', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-primary">✅ Xác nhận đơn</button>
                </form>
                <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-danger">❌ Hủy đơn</button>
                </form>
            </div>
        @endif

    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Màu</th>
            <th>Size</th>
            <th>Variant ID</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>
    </thead>

    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'N/A' }}</td>
                <td>{{ $item->color ?? '-' }}</td>
                <td>{{ $item->size ?? '-' }}</td>
                <td>{{ $item->variant_id ?? '-' }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }} đ</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4 class="text-end text-danger">
    Tổng: {{ number_format($order->total_price, 0, ',', '.') }} đ
</h4>

@endsection
