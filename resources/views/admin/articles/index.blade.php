@extends('admin.layout')
@section('title', 'Insights')
@section('page-title', 'Insights')
@section('page-subtitle', 'Kelola artikel, catatan proses, dan case study ringan')

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('admin.articles.create') }}" class="admin-btn admin-btn-primary"><i class="fas fa-plus"></i> Tambah Insight</a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Judul</th><th>Status</th><th>Published</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($articles as $article)
            <tr>
                <td>
                    <p style="font-weight:600; color:#e2e8f0;">{{ $article->title }}</p>
                    <p style="font-size:0.75rem; color:#64748b;">/{{ $article->slug }}</p>
                </td>
                <td><span class="badge {{ $article->is_published ? 'badge-green' : 'badge-red' }}">{{ $article->is_published ? 'Published' : 'Draft' }}</span></td>
                <td style="color:#94a3b8;">{{ $article->published_at?->format('d M Y') ?? '-' }}</td>
                <td>
                    <div style="display:flex; gap:0.5rem;">
                        @if($article->is_published)
                        <a href="{{ route('articles.show', $article->slug) }}" target="_blank" rel="noopener noreferrer" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem;"><i class="fas fa-eye"></i></a>
                        @endif
                        <a href="{{ route('admin.articles.edit', $article) }}" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem;"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="event.preventDefault(); openAdminConfirmModal(this, 'Hapus insight ini?')">
                            @csrf @method('DELETE')
                            <button class="admin-btn admin-btn-danger" style="padding:0.375rem 0.75rem;"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center; color:#64748b; padding:2rem;">Belum ada insight.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:1rem;">
    {{ $articles->links() }}
</div>
@endsection
