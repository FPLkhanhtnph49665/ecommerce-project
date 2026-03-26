<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        return view('client.profile.index', compact('user'));
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        if ($order->status != 'pending') {
            return back()->with('error', 'Không thể hủy');
        }

        $order->update(['status' => 'cancelled']);

        OrderHistory::create([
            'order_id' => $order->id,
            'status' => 'cancelled',
            'note' => 'Khách hàng đã hủy đơn'
        ]);

        return back()->with('success', 'Đã hủy đơn');
    }
}
