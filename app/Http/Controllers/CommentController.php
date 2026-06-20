<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Support\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if ($request->filled('website')) {
            return $this->redirectToComments()->with('comment_success', 'Komentar berhasil dikirim!');
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'body' => 'required|string|min:3|max:1000',
        ]);

        // Rate limiting — max 3 komentar per IP per jam
        $key = 'comment.'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return $this->redirectToComments()
                ->withErrors(['body' => 'Terlalu banyak komentar. Coba lagi nanti.'])
                ->withInput();
        }
        RateLimiter::hit($key, 3600);

        $avatar = null;
        if ($request->hasFile('avatar')) {
            try {
                $avatar = ImageUpload::store($request->file('avatar'), 'comments/avatars', 400);
            } catch (\Throwable $exception) {
                Log::warning('Comment avatar upload failed.', ['message' => $exception->getMessage()]);
            }
        }

        Comment::create([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $avatar,
            'body' => $request->body,
            'is_approved' => false,
        ]);

        return $this->redirectToComments()
            ->with('comment_success', 'Komentar berhasil dikirim!');
    }

    private function redirectToComments()
    {
        return redirect()->route('home', [], 302)->withFragment('comments');
    }
}
