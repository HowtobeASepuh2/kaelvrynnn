@extends('layouts.app')

@section('title', 'Wisnu Nugroho | Graphic Designer & Creative Editor')
@section('meta_keywords', 'Wisnu Nugroho, Graphic Designer, Creative Editor, Portofolio, UI/UX')
@section('content')

{{-- ============ HERO SECTION ============ --}}
<section class="relative min-h-screen flex items-center pt-16 overflow-hidden">

    {{-- Background Effects --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 -left-32 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 -right-32 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-cyan-500/20 to-transparent"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            {{-- Left: Text --}}
            <div data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 text-sm font-medium mb-6">
                    <span class="w-2 h-2 bg-cyan-400 rounded-full animate-pulse"></span>
                    Available for Freelance & Collaboration
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight mb-4">
                    Hi, I'm <span class="gradient-text">Wisnu</span><br>
                    <span class="text-slate-300">Nugroho</span>
                </h1>

                <div class="flex items-center gap-3 mb-6">
    <div class="h-px w-8 bg-cyan-500"></div>
    <p class="text-cyan-400 font-medium text-lg">
        <span id="typed-text">Graphic Designer</span><span class="animate-pulse">|</span>
    </p>
</div>

                <p class="text-slate-400 text-lg leading-relaxed mb-8 max-w-lg">
                    {{ $profile->tagline ?? 'Designing visuals that speak, move, and connect.' }}
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('projects.index') }}" class="btn-primary">
                        <i class="fas fa-folder-open mr-2"></i>Lihat Project
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline">
                        <i class="fas fa-envelope mr-2"></i>Hubungi Saya
                    </a>
                </div>

                {{-- Stats --}}
                <div id="stats-section" class="flex gap-8 mt-10 pt-8 border-t border-white/5">
    <div>
        <p class="text-2xl font-bold gradient-text counter-num" data-target="7">0+</p>
        <p class="text-slate-400 text-sm">Tools Dikuasai</p>
    </div>
    <div>
        <p class="text-2xl font-bold gradient-text counter-num" data-target="3">0+</p>
        <p class="text-slate-400 text-sm">Tahun Belajar</p>
    </div>
    <div>
        <p class="text-2xl font-bold gradient-text counter-num" data-target="10">0+</p>
        <p class="text-slate-400 text-sm">Project Selesai</p>
    </div>
</div>
            </div>

            {{-- Right: Visual Card --}}
            <div class="relative" data-aos="fade-left">
                <div class="relative z-10">
                    {{-- Main Card --}}
                    <div class="glass-card rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg">
                                WN
                            </div>
                            <div>
                                <p class="font-semibold text-slate-100">Wisnu Nugroho</p>
                                <p class="text-xs text-slate-400">Graphic Designer & Creative Editor</p>
                            </div>
                            <span class="ml-auto px-2 py-1 text-xs bg-green-500/20 text-green-400 border border-green-500/20 rounded-full">
                                Open to Work
                            </span>
                        </div>

                        {{-- Software Grid --}}
                        <p class="text-xs text-slate-500 uppercase tracking-wider mb-3">Tools & Software</p>
                        <div class="grid grid-cols-4 gap-2 mb-6">
                            @foreach([
                                ['Canva', 'fa-pen-nib', 'cyan'],
                                ['Figma', 'fa-vector-square', 'purple'],
                                ['CapCut', 'fa-video', 'blue'],
                                ['Photoshop', 'fa-image', 'orange'],
                                ['PixelLab', 'fa-palette', 'pink'],
                                ['PicsArt', 'fa-star', 'yellow'],
                                ['Alight Motion', 'fa-film', 'green'],
                                ['UI/UX', 'fa-layer-group', 'red'],
                            ] as [$name, $icon, $color])
                            <div class="flex flex-col items-center gap-1.5 p-2 rounded-lg bg-white/3 hover:bg-white/8 transition-colors group">
                                <i class="fas {{ $icon }} text-slate-400 group-hover:text-cyan-400 transition-colors text-sm"></i>
                                <span class="text-xs text-slate-500 group-hover:text-slate-300 transition-colors text-center leading-tight">{{ $name }}</span>
                            </div>
                            @endforeach
                        </div>

                        {{-- Skills Preview --}}
                        <p class="text-xs text-slate-500 uppercase tracking-wider mb-3">Keahlian Utama</p>
                        <div class="space-y-2">
                            @foreach([
                                ['Graphic Design', 85],
                                ['UI/UX Design', 70],
                                ['Video Editing', 75],
                            ] as [$skill, $pct])
                            <div>
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-slate-400">{{ $skill }}</span>
                                    <span class="text-cyan-400">{{ $pct }}%</span>
                                </div>
                                <div class="h-1 bg-white/5 rounded-full">
                                    <div class="h-1 bg-gradient-to-r from-cyan-500 to-purple-500 rounded-full" style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Floating Badge 1 --}}
                    <div class="absolute -top-4 -right-4 glass-card rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
                        <i class="fas fa-award text-yellow-400 text-sm"></i>
                        <span class="text-xs font-medium text-slate-200">Creative Designer</span>
                    </div>

                    {{-- Floating Badge 2 --}}
                    <div class="absolute -bottom-4 -left-4 glass-card rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg">
                        <i class="fas fa-graduation-cap text-cyan-400 text-sm"></i>
                        <span class="text-xs font-medium text-slate-200">Sistem Informasi UNJA</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ FEATURED PROJECTS ============ --}}
@if($projects->count() > 0)
<section class="py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header
            tag="Portfolio"
            title="Featured Projects"
            subtitle="Beberapa project terbaik yang pernah saya kerjakan"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
                <x-project-card :project="$project" />
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('projects.index') }}" class="btn-outline">
                Lihat Semua Project <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ============ SKILLS PREVIEW ============ --}}
<section class="py-20 bg-[#0f1628]/50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header
            tag="Skills"
            title="Tools & Software"
            subtitle="Aplikasi dan tools yang saya kuasai untuk menciptakan karya visual terbaik"
        />

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($skills as $skill)
                <x-skill-card :skill="$skill" />
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('skills') }}" class="btn-outline">
                Lihat Semua Skills <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

{{-- ============ CTA SECTION ============ --}}
<section class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="glass-card rounded-2xl p-12 relative overflow-hidden" data-aos="fade-up">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-500 to-purple-600"></div>
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-purple-600/10 rounded-full blur-3xl pointer-events-none"></div>

            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-widest bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-4">
                Let's Work Together
            </span>
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">
                Punya Project <span class="gradient-text">Menarik?</span>
            </h2>
            <p class="text-slate-400 mb-8 max-w-lg mx-auto">
                Saya siap membantu mewujudkan ide kreatif kamu menjadi visual yang menarik dan berkesan.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('contact') }}" class="btn-primary">
                    <i class="fas fa-paper-plane mr-2"></i>Mulai Diskusi
                </a>
                @if($profile && $profile->whatsapp)
                <a href="{{ $profile->whatsapp }}" target="_blank" class="btn-outline">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Typed text animation
    const texts = [
        'Graphic Designer',
        'Creative Editor',
        'UI/UX Enthusiast',
        'Content Designer',
        'Video Editor'
    ];
    let textIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    const typedEl = document.getElementById('typed-text');

    function typeText() {
        if (!typedEl) return;
        const current = texts[textIndex];

        if (isDeleting) {
            typedEl.textContent = current.substring(0, charIndex - 1);
            charIndex--;
        } else {
            typedEl.textContent = current.substring(0, charIndex + 1);
            charIndex++;
        }

        if (!isDeleting && charIndex === current.length) {
            isDeleting = true;
            setTimeout(typeText, 1800);
            return;
        }

        if (isDeleting && charIndex === 0) {
            isDeleting = false;
            textIndex = (textIndex + 1) % texts.length;
        }

        setTimeout(typeText, isDeleting ? 60 : 100);
    }

    typeText();

    // Counter animation
    function animateCounter(el, target, duration = 1500) {
        let start = 0;
        const step = target / (duration / 16);
        const timer = setInterval(() => {
            start += step;
            if (start >= target) {
                el.textContent = target + '+';
                clearInterval(timer);
            } else {
                el.textContent = Math.floor(start) + '+';
            }
        }, 16);
    }

    // Trigger counter when visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counters = document.querySelectorAll('.counter-num');
                counters.forEach(counter => {
                    animateCounter(counter, parseInt(counter.dataset.target));
                });
                observer.disconnect();
            }
        });
    }, { threshold: 0.5 });

    const statsEl = document.getElementById('stats-section');
    if (statsEl) observer.observe(statsEl);
</script>
@endpush