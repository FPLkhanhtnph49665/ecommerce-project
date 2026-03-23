<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
// use App\Models\Post;      // Nếu có bảng bài viết
// use App\Models\Review;    // Nếu có bảng đánh giá

class HomeController extends Controller
{
    public function index()
    {
        $latestProducts = Product::latest()->take(8)->get();

        return view('client.home', compact('latestProducts'));
    }
}
