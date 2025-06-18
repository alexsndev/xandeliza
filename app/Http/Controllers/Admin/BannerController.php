<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            'text_position' => 'nullable|in:left,center,right',
            'desktop_image' => 'required|image|mimes:webp,jpeg,png,jpg|max:10240',
            'mobile_image' => 'required|image|mimes:webp,jpeg,png,jpg|max:10240',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $desktopImage = $request->file('desktop_image')->store('banners/desktop', 'public');
        $mobileImage = $request->file('mobile_image')->store('banners/mobile', 'public');

        Banner::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'text_position' => $request->text_position,
            'desktop_image' => $desktopImage,
            'mobile_image' => $mobileImage,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

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
            'text_position' => 'nullable|in:left,center,right',
            'desktop_image' => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
            'mobile_image' => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('desktop_image')) {
            Storage::disk('public')->delete($banner->desktop_image);
            $banner->desktop_image = $request->file('desktop_image')->store('banners/desktop', 'public');
        }

        if ($request->hasFile('mobile_image')) {
            Storage::disk('public')->delete($banner->mobile_image);
            $banner->mobile_image = $request->file('mobile_image')->store('banners/mobile', 'public');
        }

        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->button_text = $request->button_text;
        $banner->button_link = $request->button_link;
        $banner->text_position = $request->text_position;
        $banner->order = $request->order ?? $banner->order;
        $banner->is_active = $request->has('is_active');
        $banner->save();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner atualizado com sucesso!');
    }

    public function destroy(Banner $banner)
    {
        Storage::disk('public')->delete([$banner->desktop_image, $banner->mobile_image]);
        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner excluído com sucesso!');
    }

    public function toggleStatus(Banner $banner)
    {
        $banner->is_active = !$banner->is_active;
        $banner->save();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Status do banner atualizado com sucesso!');
    }
} 