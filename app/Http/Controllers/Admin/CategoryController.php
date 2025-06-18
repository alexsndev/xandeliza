<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('order')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon_type' => 'required|in:svg,png,code',
            'stroke_color' => 'required|string|max:20',
            'icon_color' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        // Upload do arquivo SVG/PNG
        if (($request->icon_type === 'svg' || $request->icon_type === 'png') && $request->hasFile('icon_file')) {
            $file = $request->file('icon_file');
            $path = $file->store('categories', 'public');
            $data['icon_content'] = $path;
        } else {
            $data['icon_content'] = $request->icon_content;
        }

        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success', 'Categoria criada com sucesso!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon_type' => 'required|in:svg,png,code',
            'stroke_color' => 'required|string|max:20',
            'icon_color' => 'nullable|string|max:20',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = $request->all();

        // Upload do arquivo SVG/PNG
        if (($request->icon_type === 'svg' || $request->icon_type === 'png') && $request->hasFile('icon_file')) {
            $file = $request->file('icon_file');
            $path = $file->store('categories', 'public');
            $data['icon_content'] = $path;
        } else {
            $data['icon_content'] = $request->icon_content;
        }

        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Categoria excluída com sucesso!');
    }
} 