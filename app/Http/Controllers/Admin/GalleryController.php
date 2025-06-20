<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index() {
        $galleries = Gallery::orderBy('order')->get();
        return view('admin.galleries.index', compact('galleries'));
    }
    public function create() {
        return view('admin.galleries.create');
    }
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:webp,jpeg,png,jpg|max:10240',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $image = $request->file('image')->store('galleries', 'public');
        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.galleries.index')->with('success', 'Imagem adicionada à galeria!');
    }
    public function edit(Gallery $gallery) {
        return view('admin.galleries.edit', compact('gallery'));
    }
    public function update(Request $request, Gallery $gallery) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image);
            $gallery->image = $request->file('image')->store('galleries', 'public');
        }
        $gallery->title = $request->title;
        $gallery->description = $request->description;
        $gallery->order = $request->order ?? $gallery->order;
        $gallery->is_active = $request->has('is_active');
        $gallery->save();
        return redirect()->route('admin.galleries.index')->with('success', 'Imagem da galeria atualizada!');
    }
    public function destroy(Gallery $gallery) {
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Imagem removida da galeria!');
    }
    public function toggleStatus(Gallery $gallery) {
        $gallery->is_active = !$gallery->is_active;
        $gallery->save();
        return redirect()->route('admin.galleries.index')->with('success', 'Status atualizado!');
    }
} 