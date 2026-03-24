<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Hiển thị giỏ
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('client.cart.index', compact('cart'));
    }

    // Thêm sản phẩm
    public function add($id)
{
    $product = Product::findOrFail($id);

    if ($product->stock <= 0) {
        return back()->with('error', 'Sản phẩm đã hết hàng');
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {

        if ($cart[$id]['quantity'] < $product->stock) {
            $cart[$id]['quantity']++;
        } else {
            return back()->with('error', 'Đã đạt số lượng tối đa');
        }

    } else {

        $cart[$id] = [
            'name' => $product->name,
            'price' => $product->sale_price ?? $product->price,
            'image' => $product->image,
            'quantity' => 1
        ];
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Đã thêm vào giỏ hàng');
}

    // Update số lượng
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Cập nhật thành công');
    }

    // Xóa
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã xóa sản phẩm');
    }
}
