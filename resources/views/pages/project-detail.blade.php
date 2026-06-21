@extends('layouts.app')

@section('title', ($project->seo_title ?: $project->title) . ' — Wisnu Nugroho')
@section('meta_description', $project->seo_description ?: Str::limit($project->description, 160))
@section('meta_keywords', $project->seo_keywords ?: ($project->tools . ', ' . $project->category->name))

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Back Button --}}
        <a href="{{ route('projects.index') }}"
           class="inline-flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors text-sm mb-8"
           data-aos="fade-right">
            <i class="fas fa-arrow-left"></i> Kembali ke Projects
        </a>

        {{-- Header --}}
        <div class="mb-8" data-aos="fade-up">
            <div class="flex flex-wrap items-center gap-3 mb-4">
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-cyan-500/20 text-cyan-400 border border-cyan-500/30">
                    {{ $project->category->name }}
                </span>
                <span class="text-slate-500 text-sm">{{ $project->year }}</span>
                @if($project->is_featured)
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-500/20 text-purple-400 border border-purple-500/30">
                    <i class="fas fa-star mr-1 text-xs"></i>Featured
                </span>
                @endif
                @if($project->project_status)
                <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-500/15 text-amber-300 border border-amber-500/25">
                    {{ $project->project_status }}
                </span>
                @endif
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-slate-100 mb-4">{{ $project->title }}</h1>
            <p class="text-slate-400 leading-relaxed text-lg">{{ $project->description }}</p>
        </div>

        {{-- Main Thumbnail --}}
        <div class="glass-card rounded-2xl overflow-hidden mb-8" data-aos="fade-up">
            @if($project->thumbnail)
                <img src="{{ \App\Support\ImageUpload::url($project->thumbnail) }}"
                      alt="{{ $project->title }}"
                      class="w-full object-cover max-h-[500px]" loading="lazy">
            @else
                <div class="w-full h-64 bg-gradient-to-br from-purple-900/40 to-cyan-900/40 flex items-center justify-center">
                    <i class="fas fa-image text-6xl text-slate-700"></i>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-6">

                @if($project->objective)
                <div class="glass-card rounded-xl p-6" data-aos="fade-up">
                    <h2 class="font-semibold text-slate-100 mb-3 flex items-center gap-2">
                        <i class="fas fa-bullseye text-cyan-400"></i> Tujuan Project
                    </h2>
                    <p class="text-slate-400 leading-relaxed">{{ $project->objective }}</p>
                </div>
                @endif

                @if($project->impact)
                <div class="glass-card rounded-xl p-6" data-aos="fade-up">
                    <h2 class="font-semibold text-slate-100 mb-3 flex items-center gap-2">
                        <i class="fas fa-lightbulb text-amber-300"></i> Hasil & Pembelajaran
                    </h2>
                    <p class="text-slate-400 leading-relaxed">{{ $project->impact }}</p>
                </div>
                @endif

                {{-- Gallery --}}
                @if($project->images->count() > 0)
                <div class="glass-card rounded-xl p-6" data-aos="fade-up">
                    <h2 class="font-semibold text-slate-100 mb-4 flex items-center gap-2">
                        <i class="fas fa-images text-cyan-400"></i> Galeri Project
                    </h2>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($project->images as $img)
                        <div class="rounded-lg overflow-hidden cursor-pointer group"
                             onclick="openLightbox('{{ \App\Support\ImageUpload::url($img->image) }}')">
                            <img src="{{ \App\Support\ImageUpload::url($img->image) }}"
                                 alt="{{ $img->caption ?? $project->title }}"
                                 class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-105">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-4">
                <div class="glass-card rounded-xl p-6" data-aos="fade-up">
                    <h2 class="font-semibold text-slate-100 mb-4">Detail Project</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Kategori</p>
                            <p class="text-slate-300 text-sm">{{ $project->category->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Tahun</p>
                            <p class="text-slate-300 text-sm">{{ $project->year }}</p>
                        </div>
                        @if($project->project_status)
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Status</p>
                            <p class="text-slate-300 text-sm">{{ $project->project_status }}</p>
                        </div>
                        @endif
                        @if($project->role)
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Role Saya</p>
                            <p class="text-slate-300 text-sm">{{ $project->role }}</p>
                        </div>
                        @endif
                        @if($project->duration)
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1">Durasi</p>
                            <p class="text-slate-300 text-sm">{{ $project->duration }}</p>
                        </div>
                        @endif
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-2">Tools Digunakan</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $project->tools) as $tool)
                                <span class="px-2.5 py-1 text-xs rounded-lg bg-white/5 text-slate-400 border border-white/10">
                                    {{ trim($tool) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @if($project->demo_link)
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-2">Link</p>
                            <a href="{{ route('analytics.project-demo', $project) }}" target="_blank" rel="noopener noreferrer" class="btn-primary text-sm py-2 px-4 block text-center">
                                <i class="fas fa-external-link-alt mr-2"></i>Lihat Demo
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Share --}}
                <div class="glass-card rounded-xl p-6" data-aos="fade-up">
                    <p class="text-xs text-slate-500 uppercase tracking-wider mb-3">Bagikan</p>
                    <div class="flex gap-2">
                        <a href="https://wa.me/?text={{ urlencode($project->title . ' - ' . url()->current()) }}"
                           target="_blank" rel="noopener noreferrer"
                           class="flex-1 py-2 rounded-lg bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-medium text-center hover:bg-green-500/20 transition-colors">
                            <i class="fab fa-whatsapp mr-1"></i>WA
                        </a>
                        <button onclick="copyLink()"
                           class="flex-1 py-2 rounded-lg bg-white/5 border border-white/10 text-slate-400 text-xs font-medium text-center hover:bg-white/10 transition-colors">
                            <i class="fas fa-link mr-1"></i>Copy
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related Projects --}}
        @if($related->count() > 0)
        <div class="mt-16" data-aos="fade-up">
            <h2 class="text-xl font-bold text-slate-100 mb-6">Project Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $rel)
                    <x-project-card :project="$rel" />
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 z-50 bg-black/90 hidden items-center justify-center p-4"
     onclick="closeLightbox()">
    <img id="lightbox-img" src="" alt="Preview" class="max-w-full max-h-full rounded-xl object-contain">
    <button class="absolute top-4 right-4 text-white text-2xl hover:text-cyan-400 transition-colors">
        <i class="fas fa-times"></i>
    </button>
</div>

@push('scripts')
<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    const lb = document.getElementById('lightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        // Show toast notification
        const toast = document.createElement('div');
        toast.textContent = '✓ Link berhasil disalin!';
        toast.style.cssText = `
            position: fixed; bottom: 5rem; right: 2rem; z-index: 9999;
            background: rgba(6,182,212,0.9); color: white;
            padding: 0.625rem 1rem; border-radius: 0.5rem;
            font-size: 0.875rem; font-weight: 500;
            animation: slideInRight 0.3s ease;
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 2500);
    });
}

// Close lightbox with Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeLightbox();
});

// Slide in animation for toast
const s = document.createElement('style');
s.textContent = `
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
`;
document.head.appendChild(s);
</script>
@endpush
@endsection
