@extends('layouts.client')

@section('content')

    <div class="row">

        <div class="col-md-5">
            <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid">
        </div>

        <div class="col-md-7">
            <h3>{{ $product->name }}</h3>

            <p class="text-danger fs-4">
                {{ number_format($product->price, 0, ',', '.') }} đ
            </p>

            <p>{{ $product->description }}</p>

            @if($product->stock > 0)
                <span class="badge bg-success">Còn hàng</span>
            @else
                <span class="badge bg-danger">Hết hàng</span>
            @endif

            <br><br>

            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button class="btn btn-success btn-sm">Thêm vào giỏ</button>
            </form>
        </div>

    </div>

    <hr>

    <h4>Sản phẩm liên quan</h4>

    <div class="row">
        @foreach($relatedProducts as $item)
            <div class="col-md-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top">
                    <div class="card-body">
                        <h6>{{ $item->name }}</h6>
                        <a href="{{ route('products.show', $item->slug) }}" class="btn btn-sm btn-primary">
                            Xem
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
