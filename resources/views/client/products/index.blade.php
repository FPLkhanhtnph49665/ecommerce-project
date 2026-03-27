@extends('layouts.client')

@section('content')

<div class="container">

    <!-- TITLE + FILTER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Danh sách sản phẩm</h2>

        <form method="GET" action="{{ route('products.index') }}" class="mb-4">
            <div class="d-flex flex-wrap gap-3 align-items-center">

                <!-- SORT -->
                <select name="sort" class="form-select w-auto" onchange="this.form.submit()">
                    <option value="">Sắp xếp</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                        Giá tăng dần
                    </option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                        Giá giảm dần
                    </option>
                </select>

                <!-- PRICE SLIDER -->
                <div style="min-width:250px;">
                    <label class="small text-muted">Khoảng giá</label>
                    <div id="price-slider"></div>

                    <div class="d-flex justify-content-between small mt-1">
                        <span id="min-price"></span>
                        <span id="max-price"></span>
                    </div>
                </div>

                <!-- Hidden -->
                <input type="hidden" name="min_price" id="input-min" value="{{ request('min_price', 0) }}">
                <input type="hidden" name="max_price" id="input-max" value="{{ request('max_price', 10000000) }}">

                <button class="btn btn-primary">Lọc</button>
            </div>
        </form>
    </div>

    <!-- LIST -->
    <div class="row">
        @foreach($products as $product)

            @php
                $totalStock = $product->variants->sum('stock');
                $minPrice = $product->variants->min('price');
                $maxPrice = $product->variants->max('price');
            @endphp

            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm border-0">

                    <!-- IMAGE -->
                    <div class="position-relative">
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.png') }}"
                             class="card-img-top"
                             style="height:220px; object-fit:cover;">

                        <!-- SALE -->
                        @if($product->variants->whereNotNull('sale_price')->count())
                            <span class="badge bg-danger position-absolute top-0 start-0 m-2">
                                SALE
                            </span>
                        @endif

                        <!-- OUT OF STOCK -->
                        @if($totalStock == 0)
                            <span class="badge bg-secondary position-absolute top-0 end-0 m-2">
                                Hết hàng
                            </span>
                        @endif
                    </div>

                    <!-- BODY -->
                    <div class="card-body d-flex flex-column">

                        <h6 class="fw-semibold">
                            {{ $product->name }}
                        </h6>

                        <!-- PRICE RANGE -->
                        @if($minPrice != $maxPrice)
                            <p class="text-danger fw-bold fs-5">
                                {{ number_format($minPrice) }} - {{ number_format($maxPrice) }} đ
                            </p>
                        @else
                            <p class="text-danger fw-bold fs-5">
                                {{ number_format($minPrice) }} đ
                            </p>
                        @endif

                        <!-- STOCK -->
                        @if($totalStock > 0)
                            <span class="badge bg-success mb-2">Còn hàng</span>
                        @else
                            <span class="badge bg-danger mb-2">Hết hàng</span>
                        @endif

                        <!-- ACTION -->
                        <div class="mt-auto d-flex gap-2">
                            <a href="{{ route('products.show', $product->slug) }}"
                               class="btn btn-outline-primary btn-sm w-100">
                                Xem chi tiết
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="d-flex justify-content-center mt-3">
    {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
</div>

@endsection


@section('scripts')

<link href="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/nouislider@15.7.0/dist/nouislider.min.js"></script>

<script>
    const slider = document.getElementById('price-slider');

    if (slider) {

        noUiSlider.create(slider, {
            start: [
                {{ request('min_price', 0) }},
                {{ request('max_price', 10000000) }}
            ],
            connect: true,
            range: {
                'min': 0,
                'max': 10000000
            },
            step: 100000
        });

        const minPrice = document.getElementById('min-price');
        const maxPrice = document.getElementById('max-price');

        const inputMin = document.getElementById('input-min');
        const inputMax = document.getElementById('input-max');

        slider.noUiSlider.on('update', function (values) {

            minPrice.innerHTML = Number(values[0]).toLocaleString() + ' đ';
            maxPrice.innerHTML = Number(values[1]).toLocaleString() + ' đ';

            inputMin.value = Math.round(values[0]);
            inputMax.value = Math.round(values[1]);
        });
    }
</script>

@endsection
