<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiển thị giỏ
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('client.cart.index', compact('cart'));
    }

    public function add(Request $request, $id)
{
    $variant = ProductVariant::findOrFail($request->variant_id);

    $cart = session()->get('cart', []);

    $key = $variant->id;

     if ($variant->stock < $request->quantity) {
        return back()->with('error', 'Sản phẩm không đủ hàng');
    }

     if ($variant->stock < $request->quantity) {
        return back()->with('error', 'Sản phẩm không đủ hàng');
    }
    if (isset($cart[$key])) {
        $cart[$key]['quantity'] += $request->quantity;
    } else {
        $cart[$key] = [
            'product_id' => $id,
            'variant_id' => $variant->id,
            'name' => $variant->product->name,
            'color' => $variant->color,
            'size' => $variant->size,
            'price' => $variant->sale_price ?? $variant->price,
            'image' => $variant->image ?? $variant->product->image,
            'quantity' => $request->quantity
        ];
    }

    session()->put('cart', $cart);

    return response()->json(['success' => true]);
}

    public function update(Request $request, $variant_id)
    {
        $cart = session()->get('cart');
        if(isset($cart[$variant_id])){
            $cart[$variant_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        return back();
    }

    public function remove($variant_id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$variant_id]);
        session()->put('cart', $cart);
        return back();
    }
}
