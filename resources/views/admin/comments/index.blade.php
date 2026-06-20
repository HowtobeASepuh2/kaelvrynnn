@extends('admin.layout')
@section('title', 'Komentar')
@section('page-title', 'Komentar')
@section('page-subtitle', 'Kelola, balas, dan ikut berkomentar')

@section('content')

{{-- Form Komentar Admin --}}
<div class="admin-card" style="margin-bottom: 1.5rem;">
    <h3 style="font-size: 1rem; font-weight: 600; color: #f1f5f9; margin-bottom: 1rem;">
        <i class="fas fa-comment-dots" style="color: #22d3ee; margin-right: 0.5rem;"></i>
        Tulis Komentar sebagai Admin
    </h3>
    <form action="{{ route('admin.comments.store.admin') }}" method="POST">
        @csrf
        <div style="display: flex; gap: 0.75rem; align-items: flex-end;">
            {{-- Avatar Admin --}}
            <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 2px solid rgba(6,182,212,0.3);">
                @if($profile && $profile->photo)
                    <img src="{{ \App\Support\ImageUpload::url($profile->photo) }}"
                        style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg,#06b6d4,#7c3aed); display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700; color: white;">
                        WN
                    </div>
                @endif
            </div>
            <div style="flex: 1;">
                <textarea name="body" rows="2"
                    placeholder="Tulis komentar kamu sebagai admin..."
                    class="admin-input"
                    style="resize: vertical; min-height: 3.5rem;">{{ old('body') }}</textarea>
            </div>
            <button type="submit" class="admin-btn admin-btn-primary" style="flex-shrink: 0; align-self: flex-end;">
                <i class="fas fa-paper-plane"></i> Kirim
            </button>
        </div>
    </form>
</div>

{{-- List Komentar --}}
<div style="margin-bottom: 0.75rem; display: flex; align-items: center; justify-content: space-between;">
    <h3 style="font-size: 1rem; font-weight: 600; color: #f1f5f9;">
        Semua Komentar ({{ $commentStats['total'] }})
    </h3>
    <span style="font-size: 0.8rem; color: #64748b;">
        {{ $commentStats['unreplied'] }} belum dibalas · {{ $commentStats['pinned'] }}/3 disematkan
    </span>
</div>

@forelse($comments as $comment)
<div class="admin-card" style="margin-bottom: 1rem; {{ $comment->is_pinned ? 'border-left: 3px solid rgba(250,204,21,0.7);' : ($comment->is_admin ? 'border-left: 3px solid rgba(6,182,212,0.5);' : '') }}">

    {{-- Header --}}
    <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; margin-bottom: 1rem;">
        <div style="display: flex; align-items: center; gap: 0.75rem;">

            {{-- Avatar --}}
            @if($comment->is_admin)
                <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 2px solid rgba(6,182,212,0.3);">
                    @if($profile && $profile->photo)
                        <img src="{{ \App\Support\ImageUpload::url($profile->photo) }}"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg,#06b6d4,#7c3aed); display: flex; align-items: center; justify-content: center; font-size: 0.875rem; font-weight: 700; color: white;">
                            WN
                        </div>
                    @endif
                </div>
            @else
                @if($comment->avatar)
                <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 2px solid rgba(255,255,255,0.1);">
                    <img src="{{ Storage::url($comment->avatar) }}"
                         alt="{{ $comment->name }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                @else
                <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: linear-gradient(135deg,#475569,#334155); display: flex; align-items: center; justify-content: center; font-weight: 700; color: white; font-size: 0.875rem; flex-shrink: 0;">
                    {{ strtoupper(substr($comment->name, 0, 1)) }}
                </div>
                @endif
            @endif

            <div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <p style="font-weight: 600; color: #f1f5f9; font-size: 0.9rem;">{{ $comment->name }}</p>
                    @if($comment->is_admin)
                    <span class="badge badge-cyan" style="font-size: 0.65rem;">Admin</span>
                    @endif
                    @if($comment->is_pinned)
                    <span class="badge" style="font-size: 0.65rem; background: rgba(250,204,21,0.15); color: #facc15;">
                        <i class="fas fa-thumbtack"></i> Disematkan
                    </span>
                    @endif
                </div>
                <p style="font-size: 0.75rem; color: #64748b;">
                    {{ $comment->email }} · {{ $comment->created_at->format('d M Y H:i') }}
                </p>
            </div>
        </div>

        {{-- Actions --}}
        <div style="display: flex; align-items: center; gap: 0.5rem; flex-shrink: 0;">
            @if($comment->is_approved)
            <span class="badge badge-green" style="font-size: 0.7rem;">Tampil</span>
            @else
            <span class="badge badge-red" style="font-size: 0.7rem;">Tersembunyi</span>
            @endif

            <form action="{{ route('admin.comments.pin', $comment->id) }}" method="POST">
                @csrf @method('PUT')
                <button type="submit" class="admin-btn admin-btn-secondary"
                    style="padding: 0.375rem 0.625rem; font-size: 0.75rem; {{ $comment->is_pinned ? 'color:#facc15; border-color:rgba(250,204,21,0.25);' : '' }}"
                    title="{{ $comment->is_pinned ? 'Lepas sematan' : 'Sematkan komentar' }}">
                    <i class="fas fa-thumbtack"></i>
                </button>
            </form>

            <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST">
                @csrf @method('PUT')
                <button type="submit" class="admin-btn admin-btn-secondary"
                    style="padding: 0.375rem 0.625rem; font-size: 0.75rem;"
                    title="{{ $comment->is_approved ? 'Sembunyikan' : 'Tampilkan' }}">
                    <i class="fas {{ $comment->is_approved ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                </button>
            </form>

            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST"
                onsubmit="event.preventDefault(); openAdminConfirmModal(this, 'Hapus komentar ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="admin-btn admin-btn-danger"
                    style="padding: 0.375rem 0.625rem; font-size: 0.75rem;">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- Isi Komentar --}}
    <div style="background: rgba(255,255,255,0.03); border-radius: 0.5rem; padding: 0.875rem; margin-bottom: 1rem; {{ $comment->is_admin ? 'border-left: 3px solid rgba(6,182,212,0.3);' : 'border-left: 3px solid rgba(255,255,255,0.1);' }}">
        <p style="color: #cbd5e1; font-size: 0.875rem; line-height: 1.6; margin: 0;">{{ $comment->body }}</p>
    </div>

    {{-- Hanya tampilkan form balas untuk komentar bukan admin --}}
    @if(!$comment->is_admin)

        {{-- Balasan yang sudah ada --}}
        @if($comment->hasReply())
        <div style="background: rgba(6,182,212,0.05); border: 1px solid rgba(6,182,212,0.15); border-radius: 0.5rem; padding: 0.875rem; margin-bottom: 1rem;">
            <p style="font-size: 0.75rem; color: #22d3ee; margin-bottom: 0.5rem; font-weight: 600;">
                <i class="fas fa-reply"></i> Balasan kamu — {{ $comment->replied_at->format('d M Y H:i') }}
            </p>
            <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">{{ $comment->reply }}</p>
        </div>
        @endif

        {{-- Form Balas --}}
        <form action="{{ route('admin.comments.reply', $comment->id) }}" method="POST">
            @csrf
            <div style="display: flex; gap: 0.75rem; align-items: flex-end;">
                <textarea name="reply" rows="2"
                    placeholder="{{ $comment->hasReply() ? 'Edit balasan...' : 'Tulis balasan...' }}"
                    class="admin-input"
                    style="flex: 1; resize: vertical; min-height: 3.5rem;">{{ $comment->reply }}</textarea>
                <button type="submit" class="admin-btn admin-btn-primary" style="flex-shrink: 0;">
                    <i class="fas fa-reply"></i>
                    {{ $comment->hasReply() ? 'Update' : 'Balas' }}
                </button>
            </div>
        </form>

    @endif

</div>
@empty
<div style="text-align: center; padding: 4rem 0;">
    <i class="fas fa-comments" style="font-size: 3rem; color: #1e293b; display: block; margin-bottom: 1rem;"></i>
    <p style="color: #64748b;">Belum ada komentar.</p>
</div>
@endforelse

<div style="margin-top:1rem;">
    {{ $comments->links() }}
</div>

@endsection
