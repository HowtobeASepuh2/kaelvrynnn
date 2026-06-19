@extends('admin.layout')
@section('title', 'Experience')
@section('page-title', 'Experience')
@section('page-subtitle', 'Kelola timeline pengalaman')

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('admin.experiences.create') }}" class="admin-btn admin-btn-primary">
        <i class="fas fa-plus"></i> Tambah Experience
    </a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr><th>Tahun</th><th>Judul</th><th>Deskripsi</th><th>Aksi</th></tr>
        </thead>
        <tbody>
            @forelse($experiences as $exp)
            <tr>
                <td><span class="badge badge-cyan">{{ $exp->year }}</span></td>
                <td style="font-weight:500; color:#e2e8f0;">{{ $exp->title }}</td>
                <td style="color:#94a3b8; font-size:0.8rem;">{{ Str::limit($exp->description, 60) }}</td>
                <td>
                    <div style="display:flex; gap:0.5rem;">
                        <a href="{{ route('admin.experiences.edit', $exp) }}" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Hapus experience ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-btn admin-btn-danger" style="padding:0.375rem 0.75rem;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" style="text-align:center; color:#64748b; padding:2rem;">Belum ada experience.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection