@extends('layouts.client')

@section('content')

<div class="container">

    <h2 class="fw-bold mb-4">💳 Thanh toán</h2>

    @if(count($cart) > 0)

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="row">

            <!-- LEFT: CUSTOMER INFO -->
            <div class="col-md-7">

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">Thông tin khách hàng</h5>

                        <div class="mb-3">
                            <label>Họ tên</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ auth()->user()->name ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="{{ auth()->user()->email ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Địa chỉ</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>

                    </div>
                </div>

                <!-- PAYMENT -->
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">Phương thức thanh toán</h5>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="cod" checked>
                            <label class="form-check-label">
                                Thanh toán khi nhận hàng (COD)
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="bank">
                            <label class="form-check-label">
                                Chuyển khoản ngân hàng
                            </label>
                        </div>

                    </div>
                </div>

            </div>

            <!-- RIGHT: ORDER SUMMARY -->
            <div class="col-md-5">

                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">Đơn hàng</h5>

                        @php $total = 0; @endphp

                        @foreach($cart as $item)
                            @php $subtotal = $item['price'] * $item['quantity']; @endphp
                            @php $total += $subtotal; @endphp

                            <div class="d-flex justify-content-between mb-2">
                                <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                <span>{{ number_format($subtotal, 0, ',', '.') }} đ</span>
                            </div>
                        @endforeach

                        <hr>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính</span>
                            <strong>{{ number_format($total, 0, ',', '.') }} đ</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Phí ship</span>
                            <span>Miễn phí</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold">Tổng cộng</span>
                            <span class="text-danger fw-bold fs-5">
                                {{ number_format($total, 0, ',', '.') }} đ
                            </span>
                        </div>

                        <button class="btn btn-success w-100">
                            Đặt hàng
                        </button>

                    </div>
                </div>

            </div>

        </div>

    </form>

    @else

        <div class="text-center py-5">
            <h4>🛒 Không có sản phẩm để thanh toán</h4>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                Đi mua sắm
            </a>
        </div>

    @endif

</div>

@endsection
@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000
    });
</script>
@endif
