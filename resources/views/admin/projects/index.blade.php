@extends('admin.layout')
@section('title', 'Projects')
@section('page-title', 'Projects')
@section('page-subtitle', 'Kelola semua project portofolio')

@section('content')
<div style="display:flex; justify-content:space-between; gap:1rem; align-items:flex-end; margin-bottom:1.5rem; flex-wrap:wrap;">
    <form method="GET" style="display:flex; gap:0.75rem; flex-wrap:wrap; align-items:flex-end;">
        <div>
            <label class="admin-label">Cari</label>
            <input type="text" name="search" value="{{ request('search') }}" class="admin-input" placeholder="Judul/tools..." style="width:14rem;">
        </div>
        <div>
            <label class="admin-label">Kategori</label>
            <select name="category" class="admin-input" style="width:12rem;">
                <option value="">Semua</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="admin-label">Status</label>
            <select name="status" class="admin-input" style="width:10rem;">
                <option value="">Semua</option>
                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
        </div>
        <div>
            <label class="admin-label">Featured</label>
            <select name="featured" class="admin-input" style="width:9rem;">
                <option value="">Semua</option>
                <option value="yes" {{ request('featured') === 'yes' ? 'selected' : '' }}>Ya</option>
            </select>
        </div>
        <button type="submit" class="admin-btn admin-btn-secondary"><i class="fas fa-search"></i> Filter</button>
        <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-secondary">Reset</a>
    </form>
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
                <th>Urutan</th>
                <th>Status</th>
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
                            <img src="{{ \App\Support\ImageUpload::url($project->thumbnail) }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                                <i class="fas fa-image" style="color:#475569; font-size:0.75rem;"></i>
                            </div>
                            @endif
                        </div>
                        <div>
                            <p style="font-weight:500; color:#e2e8f0;">{{ $project->title }}</p>
                            <p style="font-size:0.75rem; color:#64748b;">/{{ $project->slug }}</p>
                        </div>
                    </div>
                </td>
                <td><span class="badge badge-cyan">{{ $project->category->name }}</span></td>
                <td style="color:#94a3b8; font-size:0.8rem;">{{ Str::limit($project->tools, 30) }}</td>
                <td style="color:#94a3b8;">{{ $project->year }}</td>
                <td style="color:#94a3b8;">{{ $project->sort_order }}</td>
                <td>
                    @if($project->is_published)
                    <span class="badge badge-green">Published</span>
                    @else
                    <span class="badge badge-red">Draft</span>
                    @endif
                    @if($project->project_status)
                    <p style="font-size:0.7rem; color:#64748b; margin-top:0.25rem;">{{ $project->project_status }}</p>
                    @endif
                </td>
                <td>
                    @if($project->is_featured)
                    <span class="badge badge-purple"><i class="fas fa-star"></i> Yes</span>
                    @else
                    <span style="color:#475569; font-size:0.8rem;">—</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex; gap:0.5rem;">
                        <a href="{{ route('admin.projects.preview', $project) }}" target="_blank" rel="noopener noreferrer" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem; font-size:0.8rem;">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="admin-btn admin-btn-secondary" style="padding:0.375rem 0.75rem; font-size:0.8rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                              onsubmit="event.preventDefault(); openAdminConfirmModal(this, 'Hapus project ini?')">
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
                <td colspan="8" style="text-align:center; color:#64748b; padding:2rem;">
                    Belum ada project. <a href="{{ route('admin.projects.create') }}" style="color:#22d3ee;">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div style="margin-top:1rem;">
    {{ $projects->links() }}
</div>
@endsection
