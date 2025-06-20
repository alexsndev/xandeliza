<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = \App\Models\Product::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|image',
        ]);

        $data = $request->only('name', 'description', 'price', 'category_id');
        // Gerar slug único
        $baseSlug = Str::slug($data['name']);
        $slug = $baseSlug;
        $i = 1;
        while (\App\Models\Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Ajustar o nome do campo de categoria para product_category_id
        $data['product_category_id'] = $data['category_id'];
        unset($data['category_id']);

        \App\Models\Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit(\App\Models\Product $product)
    {
        $categories = \App\Models\ProductCategory::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, \App\Models\Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|image',
        ]);

        $data = $request->only('name', 'description', 'price', 'category_id');
        // Gerar slug único (ignorando o próprio produto)
        $baseSlug = Str::slug($data['name']);
        $slug = $baseSlug;
        $i = 1;
        while (\App\Models\Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['product_category_id'] = $data['category_id'];
        unset($data['category_id']);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produto atualizado com sucesso!');
    }
} 