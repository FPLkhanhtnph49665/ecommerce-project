<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Danh sách sản phẩm
     */
    public function index(Request $request)
{
    $query = Product::with('variants');

    // SORT
    if ($request->sort == 'price_asc') {
        $query->withMin('variants', 'price')
              ->orderBy('variants_min_price', 'asc');
    }

    if ($request->sort == 'price_desc') {
        $query->withMin('variants', 'price')
              ->orderBy('variants_min_price', 'desc');
    }

    // FILTER PRICE
    if ($request->min_price || $request->max_price) {
        $query->whereHas('variants', function ($q) use ($request) {
            if ($request->min_price) {
                $q->where('price', '>=', $request->min_price);
            }
            if ($request->max_price) {
                $q->where('price', '<=', $request->max_price);
            }
        });
    }

    $products = $query->paginate(12)->appends($request->all());

    return view('client.products.index', compact('products'));
}

    /**
     * Chi tiết sản phẩm
     */
    public function show($slug)
{
    $product = Product::with('variants')->where('slug', $slug)->firstOrFail();

    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

    return view('client.products.show', compact('product', 'relatedProducts'));
}
}
