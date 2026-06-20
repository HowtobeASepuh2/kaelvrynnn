<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\ProjectMetric;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function loginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function dashboard()
    {
        $stats = [
            'projects' => Project::count(),
            'skills' => Skill::count(),
            'messages' => ContactMessage::count(),
            'unread' => ContactMessage::where('is_read', false)->count(),
            'articles' => Article::count(),
            'project_views' => ProjectMetric::sum('views'),
            'demo_clicks' => ProjectMetric::sum('demo_clicks'),
            'cv_downloads' => DB::table('site_metrics')->where('key', 'cv_downloads')->value('value') ?? 0,
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $recentProjects = Project::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects'));
    }
}
