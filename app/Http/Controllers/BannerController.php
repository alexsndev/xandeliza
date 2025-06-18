<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url|max:255',
            'text_position' => 'required|in:left,center,right',
            'desktop_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'mobile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('desktop_image')) {
            $data['desktop_image'] = $request->file('desktop_image')->store('banners', 'public');
        }

        if ($request->hasFile('mobile_image')) {
            $data['mobile_image'] = $request->file('mobile_image')->store('banners', 'public');
        }

        Banner::create($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner criado com sucesso!');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|url|max:255',
            'text_position' => 'required|in:left,center,right',
            'desktop_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('desktop_image')) {
            if ($banner->desktop_image) {
                Storage::disk('public')->delete($banner->desktop_image);
            }
            $data['desktop_image'] = $request->file('desktop_image')->store('banners', 'public');
        }

        if ($request->hasFile('mobile_image')) {
            if ($banner->mobile_image) {
                Storage::disk('public')->delete($banner->mobile_image);
            }
            $data['mobile_image'] = $request->file('mobile_image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner atualizado com sucesso!');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->desktop_image) {
            Storage::disk('public')->delete($banner->desktop_image);
        }
        if ($banner->mobile_image) {
            Storage::disk('public')->delete($banner->mobile_image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner excluído com sucesso!');
    }
} 