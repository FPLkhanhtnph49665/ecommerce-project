<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Danh sách đơn hàng
    public function index()
    {
        $orders = Order::where('customer_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('client.orders.index', compact('orders'));
    }

    // Chi tiết đơn hàng
    public function show($id)
    {
        $order = Order::with('items.product')
            ->where('customer_id', auth()->id())
            ->findOrFail($id);

        return view('client.orders.show', compact('order'));
    }

    public function cancel($id)
{
    $user = auth()->user();

    $order = $user->orders()
        ->where('id', $id)
        ->firstOrFail();

    // Chỉ cho phép hủy khi pending
    if ($order->status !== 'pending') {
        return back()->with('error', 'Đơn hàng này không thể hủy');
    }

    DB::transaction(function () use ($order) {

        $order->update([
            'status' => 'cancelled'
        ]);

        // (OPTIONAL) hoàn lại stock nếu có
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }

    });

    return back()->with('success', 'Hủy đơn hàng thành công');
}

public function placeOrder(Request $request)
{
    $cart = session('cart', []);

    if (empty($cart)) {
        return back()->with('error', 'Giỏ hàng trống');
    }

    DB::transaction(function () use ($cart, $request) {

        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total_price' => collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']),
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'variant_id' => $item['variant_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }
    });

    session()->forget('cart');

    return redirect()->route('orders.index')->with('success', 'Đặt hàng thành công');
}
}
