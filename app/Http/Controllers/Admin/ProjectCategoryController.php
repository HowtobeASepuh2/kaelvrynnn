<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::withCount('projects')->orderBy('name')->get();

        return view('admin.project-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.project-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:project_categories,name',
            'slug' => 'nullable|string|max:255|unique:project_categories,slug',
        ]);

        $data['slug'] = Str::slug($data['slug'] ?? $data['name']);
        ProjectCategory::create($data);

        return redirect()->route('admin.project-categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(ProjectCategory $projectCategory)
    {
        return view('admin.project-categories.edit', compact('projectCategory'));
    }

    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:project_categories,name,'.$projectCategory->id,
            'slug' => 'nullable|string|max:255|unique:project_categories,slug,'.$projectCategory->id,
        ]);

        $data['slug'] = Str::slug($data['slug'] ?? $data['name']);
        $projectCategory->update($data);

        return redirect()->route('admin.project-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ProjectCategory $projectCategory)
    {
        if ($projectCategory->projects()->exists()) {
            return back()->with('error', 'Kategori masih dipakai project. Pindahkan project dulu sebelum menghapus.');
        }

        $projectCategory->delete();

        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
