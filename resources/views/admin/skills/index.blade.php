@extends('admin.layout')
@section('title', 'Skills')
@section('page-title', 'Skills & Software')
@section('page-subtitle', 'Kelola skill dan software yang dikuasai')

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('admin.skills.create') }}" class="admin-btn admin-btn-primary">
        <i class="fas fa-plus"></i> Tambah Skill
    </a>
</div>
<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Nama</th><th>Kategori</th><th>Level</th><th>Deskripsi</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($skills as $skill)
            <tr>
                <td style="font-weight:500; color:#e2e8f0;">{{ $skill->name }}</td>
                <td><span class="badge badge-purple">{{ $skill->category }}</span></td>
                <td><span class="badge badge-cyan">{{ $skill->level }}</span></td>
                <td style="color:#94a3b8; font-size:0.8rem;">{{ Str::limit($skill->description, 50) }}</td>
                <td>
                    <div style="display:flex; gap:0.5rem;">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Hapus skill ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-btn admin-btn-danger" style="padding:0.375rem 0.75rem;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="text-align:center; color:#64748b; padding:2rem;">Belum ada skill.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
