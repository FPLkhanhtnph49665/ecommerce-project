@extends('layouts.admin')

@section('content')

    <h3 class="mb-4">Bảng Điều Khiển</h3>

    <div class="row">

        <!-- Tổng Số Đơn Hàng -->
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h6>Tổng số đơn hàng</h6>
                <h3>{{ $totalOrders }}</h3>
            </div>
        </div>

        <!-- Tổng Số Sản Phẩm -->
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h6>Tổng số sản phẩm</h6>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>

        <!-- Tổng Số Khách Hàng -->
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h6>Tổng số khách hàng</h6>
                <h3>{{ $totalCustomers }}</h3>
            </div>
        </div>

        <!-- Doanh Thu -->
        <div class="col-md-3">
            <div class="card p-3 shadow-sm">
                <h6>Doanh thu</h6>
                <h3>{{ number_format($revenue, 0, ',', '.') }} đ</h3>
            </div>
        </div>

    </div>

    <hr>

    <!-- Các Đơn Hàng Mới Nhất -->
    <h5 class="mt-4">Các đơn hàng mới nhất</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Khách hàng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                    <td>
                        <span class="badge bg-{{ order_status_color($order->status) }}">
                            {{ order_status_text($order->status) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
