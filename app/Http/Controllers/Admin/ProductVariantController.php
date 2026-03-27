<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductVariantController extends Controller
{
    public function index()
    {
        $variants = ProductVariant::with('product')->paginate(10);
        return view('admin.variants.index', compact('variants'));
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.variants.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => [
                'required', 'string', 'max:50',
                Rule::unique('product_variants')->where(function ($query) use ($request) {
                    return $query->where('product_id', $request->product_id)
                                 ->where('size', $request->size);
                }),
            ],
            'size' => 'required|string|max:10',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
        ], [
            'color.unique' => 'Biến thể với màu sắc và size này đã tồn tại cho sản phẩm.',
        ]);

        ProductVariant::create($request->all());

        return redirect()->route('admin.variants.index')
                         ->with('success', 'Thêm biến thể thành công');
    }

    public function edit(ProductVariant $variant)
    {
        $products = Product::all();
        return view('admin.variants.edit', compact('variant', 'products'));
    }

    public function update(Request $request, ProductVariant $variant)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'color' => [
                'required', 'string', 'max:50',
                Rule::unique('product_variants')->ignore($variant->id)->where(function ($query) use ($request) {
                    return $query->where('product_id', $request->product_id)
                                 ->where('size', $request->size);
                }),
            ],
            'size' => 'required|string|max:10',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|string|max:255',
        ], [
            'color.unique' => 'Biến thể với màu sắc và size này đã tồn tại cho sản phẩm.',
        ]);

        $variant->update($request->all());

        return redirect()->route('admin.variants.index')
                         ->with('success', 'Cập nhật biến thể thành công');
    }

    public function destroy(ProductVariant $variant)
    {
        $variant->delete();
        return redirect()->route('admin.variants.index')
                         ->with('success', 'Xóa biến thể thành công');
    }

    public function show(ProductVariant $variant)
    {
        $variant->load('product');
        return view('admin.variants.show', compact('variant'));
    }
}
