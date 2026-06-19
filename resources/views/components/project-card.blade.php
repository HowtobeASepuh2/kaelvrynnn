@props(['project'])

<div
    class="glass-card rounded-xl overflow-hidden group hover:border-cyan-500/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:shadow-cyan-500/10"
    data-aos="fade-up"
>
    {{-- Thumbnail --}}
    <div class="relative overflow-hidden h-48">
        @if($project->thumbnail)
            <img
                src="{{ Storage::url($project->thumbnail) }}"
                alt="{{ $project->title }}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
            >
        @else
            <div class="w-full h-full bg-gradient-to-br from-purple-900/40 to-cyan-900/40 flex items-center justify-center">
                <i class="fas fa-image text-4xl text-slate-600"></i>
            </div>
        @endif

        {{-- Category Badge --}}
        <div class="absolute top-3 left-3">
            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-cyan-500/20 text-cyan-300 border border-cyan-500/30 backdrop-blur-sm">
                {{ $project->category->name }}
            </span>
        </div>

        {{-- Featured Badge --}}
        @if($project->is_featured)
        <div class="absolute top-3 right-3">
            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-500/20 text-purple-300 border border-purple-500/30 backdrop-blur-sm">
                <i class="fas fa-star text-xs mr-1"></i>Featured
            </span>
        </div>
        @endif

        {{-- Overlay on hover --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0e1a]/90 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end justify-center pb-4">
            <a href="{{ route('projects.show', $project->slug) }}"
               class="btn-primary text-sm py-2 px-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                Lihat Detail
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-5">
        <h3 class="font-semibold text-slate-100 text-base mb-1 group-hover:text-cyan-400 transition-colors line-clamp-1">
            {{ $project->title }}
        </h3>
        <p class="text-slate-400 text-sm mb-3 line-clamp-2">
            {{ $project->description }}
        </p>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-1 flex-wrap">
                @foreach(explode(',', $project->tools) as $tool)
                <span class="px-2 py-0.5 text-xs rounded bg-white/5 text-slate-400 border border-white/5">
                    {{ trim($tool) }}
                </span>
                @endforeach
            </div>
            <span class="text-xs text-slate-500">{{ $project->year }}</span>
        </div>
    </div>
</div>