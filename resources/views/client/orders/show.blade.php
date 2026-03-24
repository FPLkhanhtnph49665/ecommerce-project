@extends('layouts.admin')

@section('content')

<h3 class="mb-4">📄 Đơn hàng #{{ $order->id }}</h3>

<div class="card mb-4">
    <div class="card-body">

        <p><strong>Khách hàng:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>SĐT:</strong> {{ $order->phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>

        <p>
            <strong>Trạng thái:</strong>
            @include('admin.orders.partials.status', ['status' => $order->status])
        </p>

        <!-- Update status -->
        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-3">
            @csrf

            <select name="status" class="form-select w-25 d-inline">
                <option value="pending">Chờ xử lý</option>
                <option value="confirmed">Đã xác nhận</option>
                <option value="shipping">Đang giao</option>
                <option value="completed">Hoàn thành</option>
                <option value="cancelled">Hủy</option>
            </select>

            <button class="btn btn-success">Cập nhật</button>
        </form>

    </div>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>
    </thead>

    <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name ?? 'N/A' }}</td>
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
