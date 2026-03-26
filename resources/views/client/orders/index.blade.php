@extends('layouts.client')

@section('content')

<style>
.order-card {
    border: none;
    border-radius: 16px;
    background: #fff;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    transition: all 0.25s ease;
}

.order-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.08);
}

.order-id {
    font-weight: 600;
    letter-spacing: 1px;
}

.order-meta {
    font-size: 14px;
    color: #888;
}

.order-price {
    font-size: 20px;
    font-weight: 600;
    color: #111;
}

.badge-status {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 500;
}

.status-pending { background: #fff3cd; color: #856404; }
.status-shipping { background: #e3f2fd; color: #0d47a1; }
.status-completed { background: #e8f5e9; color: #1b5e20; }
.status-cancelled { background: #fdecea; color: #b71c1c; }

.btn-luxury {
    border-radius: 999px;
    padding: 6px 18px;
    font-size: 14px;
}

.empty-box {
    padding: 80px 0;
    text-align: center;
    color: #777;
}
</style>

<h2 class="mb-4" style="font-weight:600; letter-spacing:1px;">
    Đơn hàng của bạn
</h2>

@if($orders->count() > 0)

<div class="row g-4">

    @foreach($orders as $order)

    <div class="col-12">
        <div class="order-card p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <div class="order-id">ORDER #{{ $order->id }}</div>
                    <div class="order-meta">
                        {{ $order->created_at->format('d M Y') }}
                    </div>
                </div>

                <div>
                    @if($order->status == 'pending')
                        <span class="badge-status status-pending">⏳ Chờ xử lý</span>
                    @elseif($order->status == 'shipping')
                        <span class="badge-status status-shipping">🚚 Đang giao</span>
                    @elseif($order->status == 'completed')
                        <span class="badge-status status-completed">✅ Hoàn thành</span>
                    @else
                        <span class="badge-status status-cancelled">❌ Đã hủy</span>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">

                <div class="order-price">
                    {{ number_format($order->total_price, 0, ',', '.') }} đ
                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('orders.show', $order->id) }}"
                       class="btn btn-outline-dark btn-sm btn-luxury">
                        Xem chi tiết
                    </a>

                    @if($order->status == 'pending')
                        <form action="{{ route('orders.cancel', $order->id) }}"
                              method="POST"
                              onsubmit="return confirm('Hủy đơn hàng này?')">
                            @csrf
                            @method('PATCH')

                            <button class="btn btn-outline-danger btn-sm btn-luxury">
                                Hủy
                            </button>
                        </form>
                    @endif

                </div>

            </div>

        </div>
    </div>

    @endforeach

</div>

<div class="mt-4">
    {{ $orders->links() }}
</div>

@else

<div class="empty-box">
    <h4 class="mb-3">Bạn chưa có đơn hàng</h4>
    <a href="{{ route('products.index') }}" class="btn btn-dark btn-luxury">
        Bắt đầu mua sắm
    </a>
</div>

@endif

@endsection
