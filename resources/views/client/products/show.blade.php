@extends('layouts.client')

@section('title', $product->name)

@section('content')

<nav class="mb-3">
    <a href="{{ route('home') }}">Trang chủ</a> /
    <a href="{{ route('products.index') }}">Sản phẩm</a> /
    <span>{{ $product->name }}</span>
</nav>

<div class="row g-4">

    <!-- IMAGE -->
    <div class="col-md-5">
        <img id="main-image"
             src="{{ asset('storage/' . $product->image) }}"
             class="img-fluid rounded">
    </div>

    <!-- INFO -->
    <div class="col-md-7">

        <h2 class="fw-bold">{{ $product->name }}</h2>

        <!-- PRICE -->
        <div class="mb-3">
            <span id="product-price" class="text-danger fs-3 fw-bold">
                {{ number_format($product->sale_price ?? $product->price) }} đ
            </span>
        </div>

        <!-- STOCK -->
        <div id="stock-status" class="mb-3">
            <span class="badge bg-success">✔ Còn hàng</span>
        </div>

        <p>{{ $product->description }}</p>

        <!-- FORM -->
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf

            @if($product->variants->count() > 0)

                <!-- COLOR -->
                <div class="mb-3">
                    <label class="fw-bold">Màu</label>
                    <div class="d-flex gap-2 flex-wrap">
                        @foreach($product->variants->pluck('color')->unique() as $color)
                            <button type="button"
                                    class="btn btn-outline-dark btn-sm color-item"
                                    data-color="{{ $color }}">
                                {{ $color }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- SIZE -->
                <div class="mb-3">
                    <label class="fw-bold">Size</label>
                    <div id="size-list" class="d-flex gap-2 flex-wrap"></div>
                </div>

                <input type="hidden" name="variant_id" id="variant_id">

            @endif

            <!-- QUANTITY -->
            <input type="number" name="quantity" value="1" min="1"
                   class="form-control w-25 mb-3">

            <button class="btn btn-success" id="btn-add-cart" disabled>
                🛒 Thêm vào giỏ
            </button>

        </form>

    </div>
</div>

<hr>

<!-- RELATED -->
<h4 class="mt-5 mb-3">Sản phẩm liên quan</h4>

<div class="row">
    @foreach($relatedProducts as $item)
        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-sm border-0">

                <img src="{{ asset('storage/' . $item->image) }}"
                     class="card-img-top"
                     style="height:200px; object-fit:cover">

                <div class="card-body d-flex flex-column">
                    <h6 class="fw-bold">{{ $item->name }}</h6>

                    <p class="text-danger">
                        {{ number_format($item->price) }} đ
                    </p>

                    <a href="{{ route('products.show', $item->slug) }}"
                       class="btn btn-outline-primary mt-auto btn-sm">
                        Xem
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
@section('scripts')
<script>
const variants = @json($product->variants);

let selectedColor = null;
let selectedSize = null;

const sizeList = document.getElementById('size-list');
const variantInput = document.getElementById('variant_id');
const btnAdd = document.getElementById('btn-add-cart');
const priceEl = document.getElementById('product-price');
const stockEl = document.getElementById('stock-status');
const imageEl = document.getElementById('main-image');

function formatPrice(number) {
    return new Intl.NumberFormat('vi-VN').format(number) + ' đ';
}

// 🔥 CLICK COLOR
document.querySelectorAll('.color-item').forEach(btn => {
    btn.addEventListener('click', function () {

        document.querySelectorAll('.color-item').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        selectedColor = this.dataset.color;

        renderSizes();
    });
});

// 🔥 RENDER SIZE THEO COLOR
function renderSizes() {

    sizeList.innerHTML = '';

    let filtered = variants.filter(v => v.color === selectedColor);

    let sizes = [...new Set(filtered.map(v => v.size))];

    sizes.forEach(size => {

        let variant = filtered.find(v => v.size === size);

        let disabled = variant.stock <= 0;

        sizeList.innerHTML += `
            <button type="button"
                class="btn btn-sm ${disabled ? 'btn-secondary' : 'btn-outline-primary'} size-item"
                data-size="${size}"
                ${disabled ? 'disabled' : ''}>
                ${size}
            </button>
        `;
    });

    bindSizeClick();
}

// 🔥 CLICK SIZE
function bindSizeClick() {
    document.querySelectorAll('.size-item').forEach(btn => {
        btn.addEventListener('click', function () {

            document.querySelectorAll('.size-item').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            selectedSize = this.dataset.size;

            updateVariant();
        });
    });
}

// 🔥 UPDATE VARIANT
function updateVariant() {

    let variant = variants.find(v =>
        v.color === selectedColor && v.size === selectedSize
    );

    if (!variant) return;

    variantInput.value = variant.id;
    btnAdd.disabled = false;

    // 👉 UPDATE GIÁ
    let price = variant.sale_price ?? variant.price;
    priceEl.innerText = formatPrice(price);

    // 👉 UPDATE STOCK
    stockEl.innerHTML = variant.stock > 0
        ? `<span class="badge bg-success">✔ Còn ${variant.stock}</span>`
        : `<span class="badge bg-danger">✖ Hết hàng</span>`;

    // 👉 UPDATE IMAGE
    if (variant.image) {
        imageEl.src = `/storage/${variant.image}`;
    }
}
</script>
@endsection
