<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->orderBy('sort_order')->latest()->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = ProjectCategory::all();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:project_categories,id',
            'description' => 'required|string',
            'tools'       => 'required|string',
            'year'        => 'required|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'images.*'    => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['thumbnail', 'images', '_token']);
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project = Project::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects/gallery', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image'      => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        $categories = ProjectCategory::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:project_categories,id',
            'description' => 'required|string',
            'tools'       => 'required|string',
            'year'        => 'required|string',
            'thumbnail'   => 'nullable|image|max:2048',
            'images.*'    => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['thumbnail', 'images', '_token', '_method']);
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects/gallery', 'public');
                ProjectImage::create([
                    'project_id' => $project->id,
                    'image'      => $path,
                    'sort_order' => $project->images()->count() + $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        foreach ($project->images as $img) {
            Storage::disk('public')->delete($img->image);
        }
        $project->delete();

        return back()->with('success', 'Project berhasil dihapus!');
    }
}