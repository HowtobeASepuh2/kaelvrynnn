@extends('layouts.app')

@section('title', 'Skills — Wisnu Nugroho')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <x-section-header
            tag="Kemampuan"
            title="Skills & Software"
            subtitle="Tools dan keahlian yang saya gunakan untuk menciptakan karya visual berkualitas"
        />

        {{-- Category Filter --}}
        <div class="flex flex-wrap gap-2 justify-center mb-10" data-aos="fade-up">
            <button onclick="filterSkill('all')" id="btn-all"
                class="skill-filter-btn px-4 py-2 rounded-full text-sm font-medium border border-cyan-500/50 text-cyan-400 bg-cyan-500/10 transition-all">
                Semua
            </button>
            @foreach($categories as $cat)
            <button onclick="filterSkill('{{ Str::slug($cat) }}')" id="btn-{{ Str::slug($cat) }}"
                class="skill-filter-btn px-4 py-2 rounded-full text-sm font-medium border border-white/10 text-slate-400 hover:border-cyan-500/30 hover:text-cyan-400 transition-all">
                {{ $cat }}
            </button>
            @endforeach
        </div>

        {{-- Skills Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="skills-grid">
            @foreach($skills as $skill)
            <div class="skill-item" data-category="{{ Str::slug($skill->category) }}">
                <x-skill-card :skill="$skill" />
            </div>
            @endforeach
        </div>

        {{-- Level Legend --}}
        <div class="mt-12 glass-card rounded-xl p-6" data-aos="fade-up">
            <p class="text-sm font-semibold text-slate-300 mb-4 text-center">Level Kemampuan</p>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach([
                    ['Beginner', '25%', 'from-slate-500 to-slate-400', 'Sedang mempelajari dasar-dasar'],
                    ['Intermediate', '60%', 'from-blue-500 to-cyan-400', 'Mampu mengerjakan project mandiri'],
                    ['Advanced', '85%', 'from-cyan-500 to-purple-500', 'Mahir dan sering digunakan'],
                    ['Expert', '100%', 'from-purple-500 to-pink-500', 'Sangat menguasai dan berpengalaman'],
                ] as [$level, $pct, $color, $desc])
                <div class="text-center">
                    <div class="h-1.5 bg-white/5 rounded-full mb-2">
                        <div class="h-1.5 rounded-full bg-gradient-to-r {{ $color }}" style="width: {{ $pct }}"></div>
                    </div>
                    <p class="text-xs font-medium text-slate-300">{{ $level }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $desc }}</p>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
function filterSkill(category) {
    const items = document.querySelectorAll('.skill-item');
    const buttons = document.querySelectorAll('.skill-filter-btn');

    // Update button styles
    buttons.forEach(btn => {
        btn.style.background = 'rgba(255,255,255,0.05)';
        btn.style.color = '#94a3b8';
        btn.style.borderColor = 'rgba(255,255,255,0.1)';
    });

    const activeBtn = document.getElementById('btn-' + category);
    if (activeBtn) {
        activeBtn.style.background = 'rgba(6,182,212,0.1)';
        activeBtn.style.color = '#22d3ee';
        activeBtn.style.borderColor = 'rgba(6,182,212,0.3)';
    }

    // Animate filter
    items.forEach(item => {
        if (category === 'all' || item.dataset.category === category) {
            item.style.display = 'block';
            item.style.animation = 'fadeInUp 0.4s ease forwards';
        } else {
            item.style.display = 'none';
        }
    });
}

// Add fadeInUp animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
document.head.appendChild(style);
</script>
@endpush
@endsection