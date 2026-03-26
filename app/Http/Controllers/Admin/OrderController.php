<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with('items.product', 'customer')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Cập nhật trạng thái đơn
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::with('items')->findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,confirmed,shipping,completed,cancelled'
        ]);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        try {
            DB::transaction(function () use ($order, $oldStatus, $newStatus) {

                // ✅ Trừ kho khi chuyển sang confirmed
                if ($newStatus === 'confirmed' && $oldStatus === 'pending') {
                    foreach ($order->items as $item) {
                        $variant = ProductVariant::findOrFail($item->variant_id);
                        if ($variant->stock < $item->quantity) {
                            throw new \Exception("Sản phẩm '{$variant->name}' không đủ kho (còn {$variant->stock})");
                        }
                        $variant->decrement('stock', $item->quantity);
                    }
                }

                // 🔄 Hoàn kho nếu hủy đơn
                if ($newStatus === 'cancelled' && in_array($oldStatus, ['pending', 'confirmed'])) {
                    foreach ($order->items as $item) {
                        $variant = ProductVariant::find($item->variant_id);
                        if ($variant) {
                            $variant->increment('stock', $item->quantity);
                        }
                    }
                }

                $order->status = $newStatus;
                $order->save();
            });

            return back()->with('success', "Cập nhật trạng thái thành công: $newStatus");

        } catch (\Exception $e) {
            Log::error('Lỗi cập nhật trạng thái đơn: ' . $e->getMessage());
            return back()->with('error', 'Cập nhật thất bại: ' . $e->getMessage());
        }
    }

    /**
     * Xác nhận đơn trực tiếp (tương đương chuyển pending -> confirmed)
     */
    public function confirmOrder($id)
    {
        return $this->updateStatus(new Request(['status' => 'confirmed']), $id);
    }

    /**
     * Hủy đơn trực tiếp
     */
    public function cancelOrder($id)
    {
        return $this->updateStatus(new Request(['status' => 'cancelled']), $id);
    }
}
