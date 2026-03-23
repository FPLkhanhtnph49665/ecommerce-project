@extends('layouts.client')

@section('title', 'Trang Chủ')

@section('content')
    <h1 class="mb-4">Chào mừng đến với E-Commerce Project</h1>

    <h2 class="mb-3">Sản phẩm mới</h2>
    <div class="row">
        @foreach($latestProducts as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="card-img-top"
                             alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}"
                             class="card-img-top"
                             alt="No image">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text fw-bold">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                        @if($product->sale_price)
                            <p class="card-text text-danger">
                                Giảm còn: {{ number_format($product->sale_price, 0, ',', '.') }} VND
                            </p>
                        @endif
                        {{-- <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary mt-auto">Xem chi tiết</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
