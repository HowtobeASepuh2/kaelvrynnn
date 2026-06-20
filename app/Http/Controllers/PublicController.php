<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMetric;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class PublicController extends Controller
{
    private function getProfile()
    {
        return Profile::first();
    }

    public function home()
    {
        $profile = $this->getProfile();
        $skills = Skill::orderBy('sort_order')->take(6)->get();
        $projects = Project::with('category')
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(3)->get();
        $comments = Comment::where('is_approved', true)
            ->orderByDesc('is_pinned')
            ->latest()
            ->take(10)
            ->get();
        $articles = Article::where('is_published', true)->latest('published_at')->take(3)->get();

        return view('pages.home', compact('profile', 'skills', 'projects', 'comments', 'articles'));
    }

    public function about()
    {
        $profile = $this->getProfile();

        return view('pages.about', compact('profile'));
    }

    public function skills()
    {
        $profile = $this->getProfile();
        $skills = Skill::orderBy('sort_order')->get();
        $categories = $skills->pluck('category')->unique();

        return view('pages.skills', compact('profile', 'skills', 'categories'));
    }

    public function experience()
    {
        $profile = $this->getProfile();
        $experiences = Experience::orderBy('sort_order')->get();

        return view('pages.experience', compact('profile', 'experiences'));
    }

    public function projects(Request $request)
    {
        $profile = $this->getProfile();
        $categories = ProjectCategory::withCount(['projects' => fn ($query) => $query->where('is_published', true)])->orderBy('name')->get();
        $query = Project::with('category')
            ->where('is_published', true)
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc');

        if ($request->category && $request->category !== 'all') {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%')
                    ->orWhere('tools', 'like', '%'.$request->search.'%');
            });
        }

        $projects = $query->paginate(9)->withQueryString();

        return view('pages.projects', compact('profile', 'projects', 'categories'));
    }

    public function projectDetail($slug)
    {
        $profile = $this->getProfile();
        $project = Project::with(['category', 'images'])->where('is_published', true)->where('slug', $slug)->firstOrFail();
        ProjectMetric::firstOrCreate(['project_id' => $project->id])->increment('views');
        $related = Project::with('category')
            ->where('is_published', true)
            ->where('category_id', $project->category_id)
            ->where('id', '!=', $project->id)
            ->take(3)->get();

        return view('pages.project-detail', compact('profile', 'project', 'related'));
    }

    public function services()
    {
        $profile = $this->getProfile();

        return view('pages.services', compact('profile'));
    }

    public function articles()
    {
        $profile = $this->getProfile();
        $articles = Article::where('is_published', true)->latest('published_at')->paginate(9);

        return view('pages.articles', compact('profile', 'articles'));
    }

    public function articleDetail($slug)
    {
        $profile = $this->getProfile();
        $article = Article::where('is_published', true)->where('slug', $slug)->firstOrFail();
        $related = Article::where('is_published', true)->where('id', '!=', $article->id)->latest('published_at')->take(3)->get();

        return view('pages.article-detail', compact('profile', 'article', 'related'));
    }

    public function contact()
    {
        $profile = $this->getProfile();

        return view('pages.contact', compact('profile'));
    }

    public function sendContact(Request $request)
    {
        if ($request->filled('website')) {
            return back()->with('success', 'Pesan berhasil terkirim! Saya akan segera membalas.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:2000',
        ]);

        // Rate limiting — max 3 pesan per IP per jam
        $key = 'contact.'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['message' => 'Terlalu banyak pesan. Coba lagi dalam 1 jam.']);
        }
        RateLimiter::hit($key, 3600);

        ContactMessage::create($request->only('name', 'email', 'subject', 'category', 'message'));

        return back()->with('success', 'Pesan berhasil terkirim! Saya akan segera membalas.');
    }
}
