<?php

if (!function_exists('cart_count')) {
    function cart_count()
    {
        $cart = session('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['quantity'];
        }

        return $total;
    }
}
function order_status_color($status)
{
    return match ($status) {
        'pending' => 'warning',
        'confirmed' => 'primary',
        'shipping' => 'info',
        'completed' => 'success',
        'cancelled' => 'danger',
        default => 'secondary',
    };
}

function order_status_text($status)
{
    return match ($status) {
        'pending' => 'Chờ xử lý',
        'confirmed' => 'Đã xác nhận',
        'shipping' => 'Đang giao',
        'completed' => 'Hoàn thành',
        'cancelled' => 'Đã hủy',
        default => 'Không rõ',
    };
}
