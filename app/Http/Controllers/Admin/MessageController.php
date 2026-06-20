<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::where('is_archived', false)->latest()->paginate(15);

        return view('admin.messages.index', compact('messages'));
    }

    public function markRead($id)
    {
        ContactMessage::findOrFail($id)->update(['is_read' => true]);

        return back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }

    public function archive($id)
    {
        ContactMessage::findOrFail($id)->update(['is_archived' => true]);

        return back()->with('success', 'Pesan berhasil diarsipkan.');
    }
}
