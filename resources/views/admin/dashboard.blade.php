@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali, ' . Auth::user()->name)

@section('content')

{{-- Stats Cards --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:2rem;">
    @foreach([
        ['fa-folder', 'Total Project', $stats['projects'], 'cyan'],
        ['fa-star', 'Total Skill', $stats['skills'], 'purple'],
        ['fa-envelope', 'Total Pesan', $stats['messages'], 'blue'],
        ['fa-bell', 'Pesan Belum Dibaca', $stats['unread'], 'red'],
    ] as [$icon, $label, $value, $color])
    <div class="admin-card" style="border-top:3px solid {{ $color === 'cyan' ? '#06b6d4' : ($color === 'purple' ? '#7c3aed' : ($color === 'blue' ? '#3b82f6' : '#ef4444')) }};">
        <div style="display:flex; align-items:center; justify-content:space-between;">
            <div>
                <p style="font-size:0.8rem; color:#64748b; margin-bottom:0.25rem;">{{ $label }}</p>
                <p style="font-size:2rem; font-weight:700; color:#f1f5f9;">{{ $value }}</p>
            </div>
            <div style="width:3rem; height:3rem; border-radius:0.75rem; background:rgba(255,255,255,0.05); display:flex; align-items:center; justify-content:center;">
                <i class="fas {{ $icon }}" style="color:#64748b;"></i>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">

    {{-- Recent Projects --}}
    <div class="admin-card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem;">
            <h3 style="font-size:1rem; font-weight:600; color:#f1f5f9;">Project Terbaru</h3>
            <a href="{{ route('admin.projects.index') }}" class="admin-btn admin-btn-secondary" style="font-size:0.75rem; padding:0.375rem 0.75rem;">
                Lihat Semua
            </a>
        </div>
        @forelse($recentProjects as $project)
        <div style="display:flex; align-items:center; gap:0.75rem; padding:0.625rem 0; border-bottom:1px solid rgba(255,255,255,0.04);">
            <div style="width:2.5rem; height:2.5rem; border-radius:0.5rem; background:rgba(255,255,255,0.05); overflow:hidden; flex-shrink:0;">
                @if($project->thumbnail)
                <img src="{{ Storage::url($project->thumbnail) }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center;">
                    <i class="fas fa-image" style="color:#475569; font-size:0.75rem;"></i>
                </div>
                @endif
            </div>
            <div style="flex:1; min-width:0;">
                <p style="font-size:0.875rem; font-weight:500; color:#e2e8f0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $project->title }}</p>
                <p style="font-size:0.75rem; color:#64748b;">{{ $project->category->name }}</p>
            </div>
            <span class="badge badge-cyan">{{ $project->year }}</span>
        </div>
        @empty
        <p style="color:#64748b; font-size:0.875rem; text-align:center; padding:1rem;">Belum ada project.</p>
        @endforelse
    </div>

    {{-- Recent Messages --}}
    <div class="admin-card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem;">
            <h3 style="font-size:1rem; font-weight:600; color:#f1f5f9;">Pesan Terbaru</h3>
            <a href="{{ route('admin.messages.index') }}" class="admin-btn admin-btn-secondary" style="font-size:0.75rem; padding:0.375rem 0.75rem;">
                Lihat Semua
            </a>
        </div>
        @forelse($recentMessages as $msg)
        <div style="padding:0.625rem 0; border-bottom:1px solid rgba(255,255,255,0.04);">
            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.25rem;">
                <p style="font-size:0.875rem; font-weight:500; color:#e2e8f0;">{{ $msg->name }}</p>
                @if(!$msg->is_read)
                <span class="badge badge-red">Baru</span>
                @endif
            </div>
            <p style="font-size:0.75rem; color:#64748b; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $msg->subject }}</p>
        </div>
        @empty
        <p style="color:#64748b; font-size:0.875rem; text-align:center; padding:1rem;">Belum ada pesan.</p>
        @endforelse
    </div>
</div>

{{-- Quick Actions --}}
<div class="admin-card" style="margin-top:1.5rem;">
    <h3 style="font-size:1rem; font-weight:600; color:#f1f5f9; margin-bottom:1rem;">Quick Actions</h3>
    <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
        <a href="{{ route('admin.projects.create') }}" class="admin-btn admin-btn-primary">
            <i class="fas fa-plus"></i> Tambah Project
        </a>
        <a href="{{ route('admin.skills.create') }}" class="admin-btn admin-btn-secondary">
            <i class="fas fa-plus"></i> Tambah Skill
        </a>
        <a href="{{ route('admin.experiences.create') }}" class="admin-btn admin-btn-secondary">
            <i class="fas fa-plus"></i> Tambah Experience
        </a>
        <a href="{{ route('admin.messages.index') }}" class="admin-btn admin-btn-secondary">
            <i class="fas fa-envelope"></i> Baca Pesan
        </a>
    </div>
</div>

@endsection