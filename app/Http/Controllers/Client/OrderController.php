<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;

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
}
