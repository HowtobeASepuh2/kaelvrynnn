@extends('layouts.app')

@section('title', 'Projects — Wisnu Nugroho')
@section('meta_description', 'Koleksi project desain grafis, UI/UX, social media design, dan video editing karya Wisnu Nugroho.')
@section('meta_keywords', 'Project Desain Grafis, UI/UX Design, Portofolio Wisnu Nugroho')
@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <x-section-header
            tag="Portfolio"
            title="Semua Project"
            subtitle="Kumpulan karya desain grafis, UI/UX, social media, dan video editing"
        />

        {{-- Filter & Search --}}
        <div class="flex flex-col sm:flex-row gap-4 mb-10" data-aos="fade-up">

            {{-- Search --}}
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 text-sm"></i>
                <input
                    type="text"
                    id="search-input"
                    placeholder="Cari project..."
                    value="{{ request('search') }}"
                    class="w-full bg-white/5 border border-white/10 rounded-xl pl-11 pr-4 py-3 text-slate-300 placeholder-slate-500 focus:outline-none focus:border-cyan-500/50 transition-colors text-sm"
                >
            </div>

            {{-- Category Filter --}}
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('projects.index') }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ !request('category') ? 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30' : 'bg-white/5 text-slate-400 border border-white/10 hover:border-cyan-500/30 hover:text-cyan-400' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('projects.index', ['category' => $cat->slug]) }}"
                   class="px-4 py-2 rounded-xl text-sm font-medium transition-all {{ request('category') === $cat->slug ? 'bg-cyan-500/20 text-cyan-400 border border-cyan-500/30' : 'bg-white/5 text-slate-400 border border-white/10 hover:border-cyan-500/30 hover:text-cyan-400' }}">
                    {{ $cat->name }}
                    <span class="ml-1 text-xs opacity-60">({{ $cat->projects_count }})</span>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Projects Grid --}}
        @if($projects->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="projects-grid">
            @foreach($projects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <i class="fas fa-folder-open text-5xl text-slate-700 mb-4"></i>
            <p class="text-slate-400">Belum ada project di kategori ini.</p>
            <a href="{{ route('projects.index') }}" class="btn-outline mt-4 inline-block">Lihat Semua</a>
        </div>
        @endif

    </div>
</div>

@push('scripts')
<script>
document.getElementById('search-input').addEventListener('input', function() {
    const val = this.value;
    const url = new URL(window.location.href);
    if (val) { url.searchParams.set('search', val); }
    else { url.searchParams.delete('search'); }
    clearTimeout(this._timer);
    this._timer = setTimeout(() => window.location.href = url.toString(), 500);
});
</script>
@endpush
@endsection