@props(['tag' => 'Section', 'title', 'subtitle' => null])

<div class="text-center mb-12" data-aos="fade-up">
    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-widest bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-4">
        {{ $tag }}
    </span>
    <h2 class="section-title gradient-text">{{ $title }}</h2>
    @if($subtitle)
    <p class="text-slate-400 mt-3 max-w-2xl mx-auto">{{ $subtitle }}</p>
    @endif
</div>