@extends('layouts.admin')

@section('content')

<h3 class="mb-4">📦 Quản lý đơn hàng</h3>

<table class="table table-bordered align-middle">
    <thead>
        <tr>
            <th>#</th>
            <th>Khách hàng</th>
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

                <td>{{ $order->name ?? $order->customer->name ?? 'N/A' }}</td>

                <td class="text-danger fw-bold">
                    {{ number_format($order->total_price, 0, ',', '.') }} đ
                </td>

                <td>
                    @include('profile.partials.status', ['status' => $order->status])
                </td>

                <td>{{ $order->created_at->format('d/m/Y') }}</td>

                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}"
                       class="btn btn-sm btn-primary">
                        Xem
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $orders->links() }}

@endsection
