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

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Đã thêm vào giỏ hàng',
                'cart_count' => count(session('cart', [])),
            ]);
        }

        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công');
    }

    public function update(Request $request, $key)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$key])) {
            return back();
        }

        $variant = \App\Models\ProductVariant::find($cart[$key]['variant_id']);

        if ($variant->stock < $request->quantity) {
            return back()->with('error', 'Không đủ hàng');
        }

        $cart[$key]['quantity'] = $request->quantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Cập nhật thành công');
    }

    public function remove($variant_id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$variant_id]);
        session()->put('cart', $cart);
        return back();
    }
}
