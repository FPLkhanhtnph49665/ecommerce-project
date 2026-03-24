@extends('layouts.client')

@section('content')

<h2 class="mb-4">📦 Đơn hàng của tôi</h2>

@if($orders->count() > 0)

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>#</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Ngày</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>#{{ $order->id }}</td>

                <td class="text-danger fw-bold">
                    {{ number_format($order->total_price, 0, ',', '.') }} đ
                </td>

                <td>
                    @if($order->status == 'pending')
                        <span class="badge bg-warning">Chờ xử lý</span>
                    @elseif($order->status == 'shipping')
                        <span class="badge bg-info">Đang giao</span>
                    @elseif($order->status == 'completed')
                        <span class="badge bg-success">Hoàn thành</span>
                    @else
                        <span class="badge bg-danger">Đã hủy</span>
                    @endif
                </td>

                <td>{{ $order->created_at->format('d/m/Y') }}</td>

                <td>
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                        Xem
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $orders->links() }}

@else

<div class="text-center py-5">
    <h4>Bạn chưa có đơn hàng nào</h4>
    <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
        Mua ngay
    </a>
</div>

@endif

@endsection
