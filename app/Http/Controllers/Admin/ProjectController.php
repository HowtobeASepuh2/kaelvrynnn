<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use App\Support\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with('category')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('tools', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->category, fn ($query, $category) => $query->where('category_id', $category))
            ->when($request->status === 'published', fn ($query) => $query->where('is_published', true))
            ->when($request->status === 'draft', fn ($query) => $query->where('is_published', false))
            ->when($request->featured === 'yes', fn ($query) => $query->where('is_featured', true))
            ->orderBy('sort_order')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = ProjectCategory::orderBy('name')->get();

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    public function create()
    {
        $categories = ProjectCategory::orderBy('name')->get();

        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug',
            'category_id' => 'required|exists:project_categories,id',
            'description' => 'required|string',
            'project_status' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'impact' => 'nullable|string',
            'tools' => 'required|string',
            'year' => 'required|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except([
            'thumbnail',
            'og_image',
            'images',
            '_token',
        ]);

        $data['slug'] = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->title) . '-' . Str::random(5);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = ImageUpload::store(
                $request->file('thumbnail'),
                'projects',
                1200
            );
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = ImageUpload::store(
                $request->file('og_image'),
                'projects/og',
                1200
            );
        }

        $project = Project::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = ImageUpload::store(
                    $image,
                    'projects/gallery',
                    1400
                );

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil ditambahkan!');
    }

    public function edit(Project $project)
    {
        $project->load(['category', 'images']);

        $categories = ProjectCategory::orderBy('name')->get();

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:projects,slug,' . $project->id,
            'category_id' => 'required|exists:project_categories,id',
            'description' => 'required|string',
            'project_status' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'impact' => 'nullable|string',
            'tools' => 'required|string',
            'year' => 'required|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->except([
            'thumbnail',
            'og_image',
            'images',
            '_token',
            '_method',
        ]);

        $data['slug'] = $request->filled('slug')
            ? Str::slug($request->slug)
            : Str::slug($request->title) . '-' . Str::random(5);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                ImageUpload::delete($project->thumbnail);
            }

            $data['thumbnail'] = ImageUpload::store(
                $request->file('thumbnail'),
                'projects',
                1200
            );
        }

        if ($request->hasFile('og_image')) {
            if ($project->og_image) {
                ImageUpload::delete($project->og_image);
            }

            $data['og_image'] = ImageUpload::store(
                $request->file('og_image'),
                'projects/og',
                1200
            );
        }

        $project->update($data);

        if ($request->hasFile('images')) {
            $currentCount = $project->images()->count();

            foreach ($request->file('images') as $index => $image) {
                $path = ImageUpload::store(
                    $image,
                    'projects/gallery',
                    1400
                );

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image' => $path,
                    'sort_order' => $currentCount + $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return back()->with('success', 'Project berhasil dihapus!');
    }

    public function preview(Project $project)
    {
        $profile = Profile::first();

        $project->load(['category', 'images']);

        $related = Project::with('category')
            ->where('is_published', true)
            ->where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->take(3)
            ->get();

        return view('pages.project-detail', compact('profile', 'project', 'related'));
    }

    public function destroyImage(ProjectImage $image)
    {
        $image->delete();

        return back()->with('success', 'Gambar galeri berhasil dihapus.');
    }
}
