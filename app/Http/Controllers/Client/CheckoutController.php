<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
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

        // Tạo order items
        foreach ($cart as $item) {
            // 🔹 Lấy variant trước
            $variant = ProductVariant::where('product_id', $item['product_id'])
                ->where('color', $item['color'] ?? null)
                ->where('size', $item['size'] ?? null)
                ->firstOrFail(); // nếu không tìm thấy sẽ báo lỗi

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'variant_id' => $variant->id, // ✅ đã khai báo $variant
                'product_name' => $item['name'],
                'color' => $variant->color,
                'size' => $variant->size,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // Xóa giỏ hàng
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Đặt hàng thành công');
    }
}
