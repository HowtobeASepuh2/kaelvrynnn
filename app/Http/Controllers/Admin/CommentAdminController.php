<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentAdminController extends Controller
{
    public function index()
    {
        $comments = Comment::latest()->get();
        return view('admin.comments.index', compact('comments'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|min:3|max:1000',
        ]);

        Comment::findOrFail($id)->update([
            'reply'      => $request->reply,
            'replied_at' => now(),
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['is_approved' => !$comment->is_approved]);
        return back()->with('success', 'Status komentar diperbarui.');
    }

    public function destroy($id)
    {
        Comment::findOrFail($id)->delete();
        return back()->with('success', 'Komentar berhasil dihapus.');
    }
}