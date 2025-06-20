<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExperienceController extends Controller
{
    public function index() {
        $experiences = Experience::orderBy('order')->get();
        return view('admin.experiences.index', compact('experiences'));
    }
    public function create() {
        return view('admin.experiences.create');
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        $image = $request->hasFile('image') ? $request->file('image')->store('experiences', 'public') : null;
        Experience::create([
            'name' => $request->name,
            'image' => $image,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);
        return redirect()->route('admin.experiences.index')->with('success', 'Experiência adicionada!');
    }
    public function edit(Experience $experience) {
        return view('admin.experiences.edit', compact('experience'));
    }
    public function update(Request $request, Experience $experience) {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:webp,jpeg,png,jpg|max:10240',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);
        if ($request->hasFile('image')) {
            if ($experience->image) Storage::disk('public')->delete($experience->image);
            $experience->image = $request->file('image')->store('experiences', 'public');
        }
        $experience->name = $request->name;
        $experience->order = $request->order ?? $experience->order;
        $experience->is_active = $request->has('is_active');
        $experience->save();
        return redirect()->route('admin.experiences.index')->with('success', 'Experiência atualizada!');
    }
    public function destroy(Experience $experience) {
        if ($experience->image) Storage::disk('public')->delete($experience->image);
        $experience->delete();
        return redirect()->route('admin.experiences.index')->with('success', 'Experiência removida!');
    }
    public function toggleStatus(Experience $experience) {
        $experience->is_active = !$experience->is_active;
        $experience->save();
        return redirect()->route('admin.experiences.index')->with('success', 'Status atualizado!');
    }
} 