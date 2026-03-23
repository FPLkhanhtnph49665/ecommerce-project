<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Dashboard
     */
    public function dashboard()
    {
        // Tổng số
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::where('role', 'customer')->count();

        // Doanh thu (chỉ tính đơn hoàn thành)
        $revenue = Order::where('status', 'completed')
            ->sum('total_price');

        // Đơn hàng theo trạng thái
        $orderStats = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Đơn hàng mới nhất
        $latestOrders = Order::with('customer')
            ->latest()
            ->take(5)
            ->get();

        // Sản phẩm mới nhất
        $latestProducts = Product::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalCustomers',
            'revenue',
            'orderStats',
            'latestOrders',
            'latestProducts'
        ));
    }
}
