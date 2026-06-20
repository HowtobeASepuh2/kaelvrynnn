<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Support\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest('published_at')->latest()->paginate(12);

        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug',
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string|min:20',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['slug'] = $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->title).'-'.Str::random(5);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('cover_image')) {
            if ($article->cover_image) {
                ImageUpload::delete($article->cover_image);
            }
            $data['cover_image'] = ImageUpload::store($request->file('cover_image'), 'articles', 1400);
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Insight berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:articles,slug,'.$article->id,
            'excerpt' => 'nullable|string|max:500',
            'body' => 'required|string|min:20',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['slug'] = $request->filled('slug') ? Str::slug($request->slug) : $article->slug;
        $wasPublished = $article->is_published;
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? ($article->published_at ?? now()) : null;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = ImageUpload::store($request->file('cover_image'), 'articles', 1400);
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', $wasPublished ? 'Insight diperbarui.' : 'Insight berhasil disimpan.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return back()->with('success', 'Insight berhasil dihapus.');
    }
}
