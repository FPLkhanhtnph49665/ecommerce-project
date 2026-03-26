@extends('layouts.client')

@section('content')

<h3 class="mb-4">📄 Chi tiết đơn hàng #{{ $order->id }}</h3>

<!-- THÔNG TIN ĐƠN -->
<div class="card shadow-sm border-0 rounded-3 mb-4">
    <div class="card-body">

        <div class="row">

            <div class="col-md-6">
                <p class="mb-1 text-muted">Khách hàng</p>
                <strong>{{ $order->name }}</strong>

                <p class="mt-3 mb-1 text-muted">Số điện thoại</p>
                <strong>{{ $order->phone }}</strong>

                <p class="mt-3 mb-1 text-muted">Email</p>
                <strong>{{ $order->email }}</strong>
            </div>

            <div class="col-md-6">
                <p class="mb-1 text-muted">Địa chỉ nhận hàng</p>
                <strong>{{ $order->address }}</strong>

                <p class="mt-3 mb-1 text-muted">Ngày đặt</p>
                <strong>{{ $order->created_at->format('d/m/Y H:i') }}</strong>

                <p class="mt-3 mb-1 text-muted">Trạng thái</p>

                @if($order->status == 'pending')
                    <span class="badge bg-warning text-dark">⏳ Chờ xử lý</span>
                @elseif($order->status == 'shipping')
                    <span class="badge bg-info">🚚 Đang giao</span>
                @elseif($order->status == 'completed')
                    <span class="badge bg-success">✅ Hoàn thành</span>
                @else
                    <span class="badge bg-danger">❌ Đã hủy</span>
                @endif
            </div>

        </div>

        <!-- ACTION -->
        <div class="mt-4">
            @if($order->status == 'pending')
                <form action="{{ route('orders.cancel', $order->id) }}"
                      method="POST"
                      onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                    @csrf
                    @method('PATCH')

                    <button class="btn btn-outline-danger">
                        ❌ Hủy đơn hàng
                    </button>
                </form>
            @endif
        </div>

    </div>
</div>

<!-- DANH SÁCH SẢN PHẨM -->
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body">

        <h5 class="mb-3">🛒 Sản phẩm trong đơn</h5>

        @foreach($order->items as $item)

            @php
                // Ưu tiên variant nếu có
                $size = $item->variant->size ?? $item->size ?? null;
                $color = $item->variant->color ?? $item->color ?? null;
            @endphp

            <div class="d-flex align-items-center border-bottom py-3">

                <!-- ẢNH -->
                <img src="{{ asset($item->product->image ?? 'default.png') }}"
                     width="70"
                     height="70"
                     class="rounded me-3"
                     style="object-fit: cover">

                <!-- INFO -->
                <div class="flex-grow-1">

                    <h6 class="mb-1">
                        {{ $item->product->name ?? 'Sản phẩm đã xóa' }}
                    </h6>

                    <!-- SIZE + COLOR -->
                    <div class="small text-muted">

                        @if($size)
                            <span class="me-2">Size: <strong>{{ $size }}</strong></span>
                        @endif

                        @if($color)
                            <span>
                                Màu:
                                <span style="
                                    display:inline-block;
                                    width:12px;
                                    height:12px;
                                    border-radius:50%;
                                    background: {{ strtolower($color) }};
                                    border:1px solid #ccc;
                                    margin: 0 4px;
                                "></span>
                                <strong>{{ $color }}</strong>
                            </span>
                        @endif

                    </div>

                    <small class="text-muted">
                        SL: {{ $item->quantity }}
                    </small>

                </div>

                <!-- GIÁ -->
                <div class="text-end">

                    <div class="text-danger fw-bold">
                        {{ number_format($item->price, 0, ',', '.') }} đ
                    </div>

                    <small class="text-muted">
                        Tổng:
                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ
                    </small>

                </div>

            </div>

        @endforeach

        <!-- TỔNG -->
        <div class="text-end mt-4">
            <h5>
                Tổng tiền:
                <span class="text-danger">
                    {{ number_format($order->total_price, 0, ',', '.') }} đ
                </span>
            </h5>
        </div>

    </div>
</div>

@endsection
