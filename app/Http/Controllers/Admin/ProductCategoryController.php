<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('name')->get();
        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data = $request->only('name');
        $data['slug'] = Str::slug($data['name']);
        ProductCategory::create($data);
        return redirect()->route('admin.product-categories.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $data = $request->only('name');
        $data['slug'] = Str::slug($data['name']);
        $productCategory->update($data);
        return redirect()->route('admin.product-categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect()->route('admin.product-categories.index')->with('success', 'Categoria excluída com sucesso!');
    }
} 