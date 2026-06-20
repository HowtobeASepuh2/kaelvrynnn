@extends('admin.layout')
@section('title', 'Kategori Project')
@section('page-title', 'Kategori Project')
@section('page-subtitle', 'Kelola pengelompokan project portofolio')

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('admin.project-categories.create') }}" class="admin-btn admin-btn-primary"><i class="fas fa-plus"></i> Tambah Kategori</a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead><tr><th>Nama</th><th>Slug</th><th>Project</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td style="font-weight:600; color:#e2e8f0;">{{ $category->name }}</td>
                <td style="color:#94a3b8;">/{{ $category->slug }}</td>
                <td><span class="badge badge-cyan">{{ $category->projects_count }}</span></td>
                <td>
                    <div style="display:flex; gap:0.5rem;">
                        <a href="{{ route('admin.project-categories.edit', $category) }}" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem;"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.project-categories.destroy', $category) }}" method="POST" onsubmit="event.preventDefault(); openAdminConfirmModal(this, 'Hapus kategori ini?')">
                            @csrf @method('DELETE')
                            <button class="admin-btn admin-btn-danger" style="padding:0.375rem 0.75rem;"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center; color:#64748b; padding:2rem;">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
