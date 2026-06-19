@extends('admin.layout')
@section('title', 'Projects')
@section('page-title', 'Projects')
@section('page-subtitle', 'Kelola semua project portofolio')

@section('content')
<div style="display:flex; justify-content:flex-end; margin-bottom:1.5rem;">
    <a href="{{ route('admin.projects.create') }}" class="admin-btn admin-btn-primary">
        <i class="fas fa-plus"></i> Tambah Project
    </a>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>Project</th>
                <th>Kategori</th>
                <th>Tools</th>
                <th>Tahun</th>
                <th>Featured</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>
                    <div style="display:flex; align-items:center; gap:0.75rem;">
                        <div style="width:2.5rem; height:2.5rem; border-radius:0.5rem; background:rgba(255,255,255,0.05); overflow:hidden; flex-shrink:0;">
                            @if($project->thumbnail)
                            <img src="{{ Storage::url($project->thumbnail) }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-image" style="color:#475569; font-size:0.75rem;"></i>
                            </div>
                            @endif
                        </div>
                        <div>
                            <p style="font-weight:500; color:#e2e8f0;">{{ $project->title }}</p>
                            <p style="font-size:0.75rem; color:#64748b;">{{ Str::limit($project->description, 40) }}</p>
                        </div>
                    </div>
                </td>
                <td><span class="badge badge-cyan">{{ $project->category->name }}</span></td>
                <td style="color:#94a3b8; font-size:0.8rem;">{{ Str::limit($project->tools, 30) }}</td>
                <td style="color:#94a3b8;">{{ $project->year }}</td>
                <td>
                    @if($project->is_featured)
                    <span class="badge badge-purple"><i class="fas fa-star"></i> Yes</span>
                    @else
                    <span style="color:#475569; font-size:0.8rem;">—</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex; gap:0.5rem;">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem; font-size:0.8rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                              onsubmit="return confirm('Hapus project ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="admin-btn admin-btn-danger" style="padding:0.375rem 0.75rem; font-size:0.8rem;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center; color:#64748b; padding:2rem;">
                    Belum ada project. <a href="{{ route('admin.projects.create') }}" style="color:#22d3ee;">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection