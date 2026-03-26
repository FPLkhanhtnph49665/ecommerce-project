@extends('layouts.client')

@section('content')

    <div class="container">

        <h2 class="fw-bold mb-4">🛒 Giỏ hàng của bạn</h2>

        @if(count($cart) > 0)

            <div class="row">

                <!-- LEFT -->
                <div class="col-md-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $total = 0; @endphp

                                    @foreach($cart as $key => $item)

                                        @php
                                            $subtotal = $item['price'] * $item['quantity'];
                                            $total += $subtotal;
                                        @endphp

                                        <tr>

                                            <!-- PRODUCT -->
                                            <td class="d-flex align-items-center gap-3">
                                                <img src="{{ asset('storage/' . $item['image']) }}" width="70" class="rounded">

                                                <div>
                                                    <strong>{{ $item['name'] }}</strong>

                                                    <!-- VARIANT -->
                                                    <div>
                                                        <strong>{{ $item['name'] }}</strong><br>
                                                        <small class="text-muted">
                                                            {{ $item['color'] }} / {{ $item['size'] }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- PRICE -->
                                            <td class="text-danger fw-bold">
                                                {{ number_format($item['price'], 0, ',', '.') }} đ
                                            </td>

                                            <!-- QUANTITY -->
                                            <td>
                                                <form action="{{ route('cart.update', $key) }}" method="POST" class="d-flex gap-2">
                                                    @csrf

                                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                                        class="form-control form-control-sm" style="width:70px">

                                                    <button class="btn btn-outline-primary btn-sm">
                                                        ✔
                                                    </button>
                                                </form>
                                            </td>

                                            <!-- SUBTOTAL -->
                                            <td class="fw-bold">
                                                {{ number_format($subtotal, 0, ',', '.') }} đ
                                            </td>

                                            <!-- REMOVE -->
                                            <td>
                                                <form action="{{ route('cart.remove', $key) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-outline-danger btn-sm">
                                                        ✕
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col-md-4">

                    <div class="card shadow-sm border-0">
                        <div class="card-body">

                            <h5 class="fw-bold mb-3">Tóm tắt đơn hàng</h5>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <strong>{{ number_format($total, 0, ',', '.') }} đ</strong>
                            </div>

                            <div class="d-flex justify-content-between mb-3">
                                <span>Phí vận chuyển:</span>
                                <span class="text-success">Miễn phí</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold">Tổng cộng:</span>
                                <span class="text-danger fw-bold fs-5">
                                    {{ number_format($total, 0, ',', '.') }} đ
                                </span>
                            </div>

                            <a href="{{ route('checkout.index') }}" class="btn btn-success w-100">
                                Thanh toán
                            </a>

                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                                Tiếp tục mua hàng
                            </a>

                        </div>
                    </div>

                </div>

            </div>

        @else

            <!-- EMPTY -->
            <div class="text-center py-5">
                <h4>🛒 Giỏ hàng trống</h4>
                <p>Hãy thêm sản phẩm vào giỏ hàng của bạn</p>

                <a href="{{ route('products.index') }}" class="btn btn-primary">
                    Đi mua sắm
                </a>
            </div>

        @endif

    </div>

@endsection


@section('scripts')

    @if(session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
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

@endsection
