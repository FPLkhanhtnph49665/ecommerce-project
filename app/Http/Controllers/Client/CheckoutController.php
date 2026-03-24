<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        return view('client.checkout.index', compact('cart'));
    }

    public function store(Request $request)
{

    if (!auth()->check()) {
        return redirect()->route('dangnhap');
    }

    $cart = session('cart');

    if (!$cart) {
        return back()->with('error', 'Giỏ hàng trống');
    }

    $total = 0;

    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Tạo order
    $order = Order::create([
        'customer_id' => auth()->id(),
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'total_price' => $total,
        'status' => 'pending',
        'payment_method' => $request->payment_method
    ]);

    // Order items
    foreach ($cart as $id => $item) {
    OrderItem::create([
        'order_id' => $order->id,
        'product_id' => $id,
        'price' => $item['price'],
        'quantity' => $item['quantity'], // 🔥 BẮT BUỘC
    ]);
}

    session()->forget('cart');

    return redirect()->route('home')->with('success', 'Đặt hàng thành công');
}
}
