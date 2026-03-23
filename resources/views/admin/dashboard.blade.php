@extends('layouts.admin')

@section('content')

<h3 class="mb-4">Dashboard</h3>

<div class="row">

    <!-- Total Orders -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Total Orders</h6>
            <h3>{{ $totalOrders }}</h3>
        </div>
    </div>

    <!-- Total Products -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Total Products</h6>
            <h3>{{ $totalProducts }}</h3>
        </div>
    </div>

    <!-- Total Customers -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Total Customers</h6>
            <h3>{{ $totalCustomers }}</h3>
        </div>
    </div>

    <!-- Revenue -->
    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Revenue</h6>
            <h3>{{ number_format($revenue, 0, ',', '.') }} đ</h3>
        </div>
    </div>

</div>

<hr>

<!-- Latest Orders -->
<h5 class="mt-4">Latest Orders</h5>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($latestOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                <td>{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                <td>
                    <span class="badge bg-info">
                        {{ $order->status }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
