<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Profile;
use Illuminate\Http\Request;

class CommentAdminController extends Controller
{
    public function index()
    {
        $comments = Comment::orderByDesc('is_pinned')->latest()->paginate(10);
        $profile = Profile::first();
        $commentStats = [
            'total' => Comment::count(),
            'unreplied' => Comment::whereNull('reply')->where('is_admin', false)->count(),
            'pinned' => Comment::where('is_pinned', true)->count(),
        ];

        return view('admin.comments.index', compact('comments', 'profile', 'commentStats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string|min:3|max:1000',
        ]);

        $profile = Profile::first();

        Comment::create([
            'name' => $profile->name ?? 'Wisnu Nugroho',
            'email' => $profile->email ?? 'admin@portofolio.com',
            'body' => $request->body,
            'is_admin' => true,
            'is_approved' => true,
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|min:3|max:1000',
        ]);

        Comment::findOrFail($id)->update([
            'reply' => $request->reply,
            'replied_at' => now(),
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $isApproved = ! $comment->is_approved;

        $comment->update([
            'is_approved' => $isApproved,
            'is_pinned' => $isApproved ? $comment->is_pinned : false,
        ]);

        return back()->with('success', 'Status komentar diperbarui.');
    }

    public function pin($id)
    {
        $comment = Comment::findOrFail($id);

        if (! $comment->is_pinned && Comment::where('is_pinned', true)->count() >= 3) {
            return back()->with('error', 'Maksimal hanya 3 komentar yang bisa disematkan.');
        }

        if (! $comment->is_approved) {
            return back()->with('error', 'Komentar harus ditampilkan sebelum bisa disematkan.');
        }

        $comment->update(['is_pinned' => ! $comment->is_pinned]);

        return back()->with('success', $comment->is_pinned ? 'Komentar berhasil disematkan.' : 'Sematan komentar dilepas.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->avatar) {
            ImageUpload::delete($comment->avatar);
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}
