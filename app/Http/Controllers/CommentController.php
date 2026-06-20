<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\RateLimiter;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'body'  => 'required|string|min:3|max:1000',
        ]);

        // Rate limiting — max 3 komentar per IP per jam
        $key = 'comment.' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['body' => 'Terlalu banyak komentar. Coba lagi nanti.']);
        }
        RateLimiter::hit($key, 3600);

        Comment::create([
            'name'  => $request->name,
            'email' => $request->email,
            'body'  => $request->body,
        ]);

        return back()->with('comment_success', 'Komentar berhasil dikirim!');
    }
}