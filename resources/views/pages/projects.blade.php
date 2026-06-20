@extends('layouts.app')

@section('title', 'Projects — Wisnu Nugroho')
@section('meta_description', 'Koleksi project desain grafis, UI/UX, social media design, dan video editing karya Wisnu Nugroho.')

@section('content')
<div style="padding-top:7rem; padding-bottom:5rem;">
    <div style="max-width:72rem; margin:0 auto; padding:0 1.5rem;">

        <x-section-header
            tag="Portfolio"
            title="Semua Project"
            subtitle="Kumpulan karya desain grafis, UI/UX, social media, dan video editing"
        />

        {{-- Search & Filter --}}
        <div style="margin-bottom:2.5rem;">

            {{-- Search Box --}}
            <div style="position:relative; margin-bottom:1rem;">
                <i class="fas fa-search" style="position:absolute; left:1rem; top:50%; transform:translateY(-50%); color:#64748b; font-size:0.875rem; pointer-events:none;"></i>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari project..."
                    value="{{ request('search') }}"
                    style="
                        width:100%; box-sizing:border-box;
                        background:rgba(255,255,255,0.05);
                        border:1px solid rgba(255,255,255,0.1);
                        border-radius:0.75rem;
                        padding:0.75rem 1rem 0.75rem 2.75rem;
                        color:#e2e8f0;
                        font-size:0.875rem;
                        outline:none;
                        transition:border-color 0.2s;
                    "
                    onfocus="this.style.borderColor='rgba(6,182,212,0.5)'"
                    onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                >
            </div>

            {{-- Category Filter --}}
            <div style="display:flex; flex-wrap:wrap; gap:0.5rem;">
                <a href="{{ route('projects.index') }}"
                   style="
                        padding:0.5rem 1rem; border-radius:0.75rem; font-size:0.875rem;
                        font-weight:500; text-decoration:none; transition:all 0.2s;
                        {{ !request('category')
                            ? 'background:rgba(6,182,212,0.15); color:#22d3ee; border:1px solid rgba(6,182,212,0.3);'
                            : 'background:rgba(255,255,255,0.05); color:#94a3b8; border:1px solid rgba(255,255,255,0.1);' }}
                   ">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('projects.index', ['category' => $cat->slug, 'search' => request('search')]) }}"
                   style="
                        padding:0.5rem 1rem; border-radius:0.75rem; font-size:0.875rem;
                        font-weight:500; text-decoration:none; transition:all 0.2s;
                        {{ request('category') === $cat->slug
                            ? 'background:rgba(6,182,212,0.15); color:#22d3ee; border:1px solid rgba(6,182,212,0.3);'
                            : 'background:rgba(255,255,255,0.05); color:#94a3b8; border:1px solid rgba(255,255,255,0.1);' }}
                   ">
                    {{ $cat->name }}
                    <span style="opacity:0.6; font-size:0.75rem;">({{ $cat->projects_count }})</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Projects Grid --}}
        @if($projects->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:1.5rem;">
            @foreach($projects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>

        {{-- Result count --}}
        <p style="color:#64748b; font-size:0.875rem; margin-top:1.5rem; text-align:center;">
            Menampilkan {{ $projects->count() }} dari {{ $projects->total() }} project
            @if(request('search')) untuk "<span style="color:#22d3ee;">{{ request('search') }}</span>"@endif
            @if(request('category')) dalam kategori "<span style="color:#22d3ee;">{{ request('category') }}</span>"@endif
        </p>

        <div class="mt-6">
            {{ $projects->links() }}
        </div>

        @else
        <div style="text-align:center; padding:5rem 0;">
            <i class="fas fa-folder-open" style="font-size:3.5rem; color:#1e293b; margin-bottom:1rem; display:block;"></i>
            <p style="color:#64748b; margin-bottom:1rem;">
                @if(request('search'))
                    Tidak ada project dengan kata kunci "<span style="color:#22d3ee;">{{ request('search') }}</span>"
                @else
                    Belum ada project di kategori ini.
                @endif
            </p>
            <a href="{{ route('projects.index') }}"
               style="display:inline-block; padding:0.5rem 1.25rem; border:1px solid rgba(6,182,212,0.3); color:#22d3ee; border-radius:0.5rem; text-decoration:none; font-size:0.875rem;">
                Lihat Semua Project
            </a>
        </div>
        @endif

    </div>
</div>

@push('scripts')
<script>
    // Search dengan debounce 500ms
    let searchTimer;
    document.getElementById('search-input').addEventListener('input', function () {
        clearTimeout(searchTimer);
        const val = this.value;
        searchTimer = setTimeout(() => {
            const url = new URL(window.location.href);
            if (val.trim()) {
                url.searchParams.set('search', val.trim());
            } else {
                url.searchParams.delete('search');
            }
            // Pertahankan filter kategori yang aktif
            window.location.href = url.toString();
        }, 600);
    });
</script>
@endpush

@endsection
