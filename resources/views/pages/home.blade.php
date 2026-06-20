@extends('layouts.app')

@section('title', 'Wisnu Nugroho | Graphic Designer & Creative Editor')
@section('meta_keywords', 'Wisnu Nugroho, Graphic Designer, Creative Editor, Portofolio, UI/UX')
@section('content')

{{-- ============ HERO SECTION ============ --}}
<section class="relative flex items-center overflow-hidden" style="padding-top: 4rem; min-height: 100vh;">

    {{-- Background Effects --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 -left-32 w-96 h-96 bg-purple-600/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/3 -right-32 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-px bg-gradient-to-r from-transparent via-cyan-500/20 to-transparent"></div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 w-full" style="padding-top: 0; padding-bottom: 2rem;">
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
    <div class="relative z-10" style="padding-bottom: 1rem;">
                    {{-- Main Card --}}
                    <div class="glass-card rounded-2xl p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 rounded-xl overflow-hidden flex-shrink-0">
    @if($profile && $profile->photo)
        <img src="{{ Storage::url($profile->photo) }}"
             alt="{{ $profile->name }}"
             class="w-full h-full object-cover">
    @else
        <div class="w-full h-full bg-gradient-to-br from-cyan-500 to-purple-600 flex items-center justify-center text-white font-bold text-lg">
            {{ strtoupper(substr($profile->name ?? 'WN', 0, 2)) }}
        </div>
    @endif
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
                    <div class="absolute -bottom-4 -left-4 glass-card rounded-xl px-4 py-2.5 flex items-center gap-2 shadow-lg" style="z-index:20;">
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

{{-- ============ INSIGHTS PREVIEW ============ --}}
@if($articles->count() > 0)
<section class="py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header
            tag="Insights"
            title="Catatan & Studi Kasus"
            subtitle="Beberapa pembelajaran dan proses kreatif terbaru"
        />

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($articles as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="glass-card rounded-2xl p-6 hover:border-cyan-500/30 transition-colors">
                <p class="text-xs text-cyan-400 mb-3">{{ $article->published_at?->format('d M Y') }}</p>
                <h3 class="text-lg font-bold text-slate-100 mb-3">{{ $article->title }}</h3>
                <p class="text-slate-400 text-sm leading-relaxed">{{ $article->excerpt ?: Str::limit(strip_tags($article->body), 120) }}</p>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('articles.index') }}" class="btn-outline">
                Lihat Semua Insights <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif



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
                <a href="{{ $profile->whatsapp }}" target="_blank" rel="noopener noreferrer" class="btn-outline">
                    <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                </a>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ============ COMMENTS SECTION ============ --}}
<section id="comments" style="padding: 5rem 0; background: rgba(15, 22, 40, 0.5); scroll-margin-top: 5rem;">
    <div style="max-width: 56rem; margin: 0 auto; padding: 0 1.5rem;">

        <x-section-header
            tag="Komunitas"
            title="Komentar & Feedback"
            subtitle="Tinggalkan komentar atau feedback untuk saya. Saya akan membalasnya langsung!"
        />

        {{-- Form Komentar --}}
        <div class="glass-card" style="border-radius: 1rem; padding: 1.5rem; margin-bottom: 2.5rem;" data-aos="fade-up">
            <h3 style="font-size: 1rem; font-weight: 600; color: #f1f5f9; margin-bottom: 1.25rem;">
                <i class="fas fa-comment" style="color: #22d3ee; margin-right: 0.5rem;"></i>
                Tulis Komentar
            </h3>

            @if(session('comment_success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.2); color: #4ade80; padding: 0.75rem 1rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.875rem;">
                <i class="fas fa-check-circle"></i> {{ session('comment_success') }}
            </div>
            @endif

            <form id="comment-form" action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute; left:-9999px; opacity:0;" aria-hidden="true">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.375rem;">
                            Nama *
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="Nama kamu"
                            style="width: 100%; box-sizing: border-box; background: rgba(255,255,255,0.05); border: 1px solid {{ $errors->has('name') ? 'rgba(239,68,68,0.5)' : 'rgba(255,255,255,0.1)' }}; border-radius: 0.5rem; padding: 0.625rem 0.875rem; color: #e2e8f0; font-size: 0.875rem; outline: none;"
                            onfocus="this.style.borderColor='rgba(6,182,212,0.5)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                            required>
                        @error('name')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.375rem;">
                            Email * <span style="font-size: 0.7rem; color: #475569;">(tidak ditampilkan)</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="email@kamu.com"
                            style="width: 100%; box-sizing: border-box; background: rgba(255,255,255,0.05); border: 1px solid {{ $errors->has('email') ? 'rgba(239,68,68,0.5)' : 'rgba(255,255,255,0.1)' }}; border-radius: 0.5rem; padding: 0.625rem 0.875rem; color: #e2e8f0; font-size: 0.875rem; outline: none;"
                            onfocus="this.style.borderColor='rgba(6,182,212,0.5)'"
                            onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                            required>
                        @error('email')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.375rem;">
                        Foto Profil <span style="font-size: 0.7rem; color: #475569;">(opsional)</span>
                    </label>
                    <input type="file" name="avatar" accept="image/*"
                        style="width: 100%; box-sizing: border-box; background: rgba(255,255,255,0.05); border: 1px solid {{ $errors->has('avatar') ? 'rgba(239,68,68,0.5)' : 'rgba(255,255,255,0.1)' }}; border-radius: 0.5rem; padding: 0.625rem 0.875rem; color: #94a3b8; font-size: 0.875rem; outline: none;">
                    <p style="font-size: 0.7rem; color: #475569; margin-top: 0.25rem;">Boleh dikosongkan. Format gambar, maksimal 2MB.</p>
                    @error('avatar')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>

                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: 0.8rem; color: #94a3b8; margin-bottom: 0.375rem;">
                        Komentar *
                    </label>
                    <textarea name="body" rows="4"
                        placeholder="Tulis komentar atau feedback kamu di sini..."
                        style="width: 100%; box-sizing: border-box; background: rgba(255,255,255,0.05); border: 1px solid {{ $errors->has('body') ? 'rgba(239,68,68,0.5)' : 'rgba(255,255,255,0.1)' }}; border-radius: 0.5rem; padding: 0.625rem 0.875rem; color: #e2e8f0; font-size: 0.875rem; outline: none; resize: vertical;"
                        onfocus="this.style.borderColor='rgba(6,182,212,0.5)'"
                        onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                        required>{{ old('body') }}</textarea>
                    @error('body')<p style="color:#f87171; font-size:0.75rem; margin-top:0.25rem;">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="btn-primary" style="font-size: 0.875rem; padding: 0.625rem 1.5rem;">
                    <i class="fas fa-paper-plane" style="margin-right: 0.5rem;"></i>Kirim Komentar
                </button>
            </form>
        </div>

        {{-- List Komentar --}}
        <div>
            <h3 style="font-size: 1rem; font-weight: 600; color: #f1f5f9; margin-bottom: 1.25rem;">
                <i class="fas fa-comments" style="color: #22d3ee; margin-right: 0.5rem;"></i>
                {{ $comments->count() }} Komentar
            </h3>

@forelse($comments as $comment)
<div class="glass-card" style="border-radius: 0.75rem; padding: 1.25rem; margin-bottom: 1rem; {{ $comment->is_pinned ? 'border-left: 3px solid rgba(250,204,21,0.7);' : ($comment->is_admin ? 'border-left: 3px solid rgba(6,182,212,0.4);' : '') }}" data-aos="fade-up">

    {{-- Komentar Utama --}}
    <div style="display: flex; gap: 0.875rem;">

        {{-- Avatar --}}
        @if($comment->is_admin)
            @php $replyProfile = \App\Models\Profile::first(); @endphp
            <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 2px solid rgba(6,182,212,0.3);">
                @if($replyProfile && $replyProfile->photo)
                    <img src="{{ Storage::url($replyProfile->photo) }}"
                         alt="{{ $replyProfile->name }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg,#06b6d4,#7c3aed); display: flex; align-items: center; justify-content: center; font-size: 0.875rem; font-weight: 700; color: white;">
                        WN
                    </div>
                @endif
            </div>
        @else
            @if($comment->avatar)
            <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 2px solid rgba(255,255,255,0.1);">
                <img src="{{ Storage::url($comment->avatar) }}"
                     alt="{{ $comment->name }}"
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            @else
            <div style="width: 2.5rem; height: 2.5rem; border-radius: 50%; background: linear-gradient(135deg,#475569,#334155); display: flex; align-items: center; justify-content: center; font-size: 0.875rem; font-weight: 700; color: white; flex-shrink: 0;">
                {{ strtoupper(substr($comment->name, 0, 1)) }}
            </div>
            @endif
        @endif

        <div style="flex: 1; min-width: 0;">
            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.375rem; flex-wrap: wrap;">
                <span style="font-weight: 600; color: #f1f5f9; font-size: 0.9rem;">{{ $comment->name }}</span>
                @if($comment->is_admin)
                <span style="background: rgba(6,182,212,0.15); color: #22d3ee; font-size: 0.65rem; padding: 0.125rem 0.5rem; border-radius: 9999px; border: 1px solid rgba(6,182,212,0.2);">
                    Admin
                </span>
                @endif
                @if($comment->is_pinned)
                <span style="background: rgba(250,204,21,0.12); color: #facc15; font-size: 0.65rem; padding: 0.125rem 0.5rem; border-radius: 9999px; border: 1px solid rgba(250,204,21,0.25);">
                    <i class="fas fa-thumbtack"></i> Disematkan
                </span>
                @endif
                <span style="font-size: 0.7rem; color: #475569;">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <p style="color: #cbd5e1; font-size: 0.875rem; line-height: 1.6; margin: 0;">
                {{ $comment->body }}
            </p>
        </div>
    </div>

    {{-- Balasan Admin (hanya untuk komentar pengunjung) --}}
    @if(!$comment->is_admin && $comment->hasReply())
    <div style="margin-top: 1rem; margin-left: 3.375rem; background: rgba(6,182,212,0.05); border: 1px solid rgba(6,182,212,0.15); border-radius: 0.625rem; padding: 1rem;">
        <div style="display: flex; gap: 0.75rem;">
            @php $replyProfile = \App\Models\Profile::first(); @endphp
            <div style="width: 2rem; height: 2rem; border-radius: 50%; overflow: hidden; flex-shrink: 0; border: 1px solid rgba(6,182,212,0.3);">
                @if($replyProfile && $replyProfile->photo)
                    <img src="{{ Storage::url($replyProfile->photo) }}"
                         alt="{{ $replyProfile->name }}"
                         style="width: 100%; height: 100%; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg,#06b6d4,#7c3aed); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 700; color: white;">
                        WN
                    </div>
                @endif
            </div>
            <div style="flex: 1;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.375rem;">
                    <span style="font-weight: 600; color: #22d3ee; font-size: 0.85rem;">
                        {{ $replyProfile->name ?? 'Wisnu Nugroho' }}
                    </span>
                    <span style="background: rgba(6,182,212,0.15); color: #22d3ee; font-size: 0.65rem; padding: 0.125rem 0.5rem; border-radius: 9999px; border: 1px solid rgba(6,182,212,0.2);">
                        Admin
                    </span>
                    <span style="font-size: 0.7rem; color: #475569;">
                        {{ $comment->replied_at->diffForHumans() }}
                    </span>
                </div>
                <p style="color: #94a3b8; font-size: 0.875rem; line-height: 1.6; margin: 0;">
                    {{ $comment->reply }}
                </p>
            </div>
        </div>
    </div>
    @endif

</div>
@empty
<div style="text-align: center; padding: 3rem 0;">
    <i class="fas fa-comment-slash" style="font-size: 2.5rem; color: #1e293b; display: block; margin-bottom: 0.75rem;"></i>
    <p style="color: #475569; font-size: 0.875rem;">Belum ada komentar. Jadilah yang pertama!</p>
</div>
@endforelse

        </div>

    </div>
</section>

<div id="comment-confirm-modal" style="position: fixed; inset: 0; z-index: 90; display: none; align-items: center; justify-content: center; padding: 1.5rem; background: rgba(2,6,23,0.65); backdrop-filter: blur(10px);">
    <div style="width: 100%; max-width: 28rem; background: linear-gradient(180deg, #111827, #0f172a); border: 1px solid rgba(6,182,212,0.22); border-radius: 1rem; padding: 1.5rem; box-shadow: 0 25px 80px rgba(0,0,0,0.45); animation: commentModalPop 0.18s ease-out;">
        <div style="width: 3rem; height: 3rem; border-radius: 9999px; display: flex; align-items: center; justify-content: center; background: rgba(6,182,212,0.12); color: #22d3ee; border: 1px solid rgba(6,182,212,0.25); margin-bottom: 1rem;">
            <i class="fas fa-paper-plane"></i>
        </div>
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #f8fafc; margin: 0 0 0.5rem;">
            Kirim komentar ini?
        </h2>
        <p style="color: #cbd5e1; line-height: 1.6; font-size: 0.9rem; margin: 0 0 1.25rem;">
            Pastikan nama, email, dan isi komentar sudah benar. Setelah dikirim, komentar tidak bisa kamu edit atau hapus sendiri.
        </p>
        <div style="display: flex; gap: 0.875rem; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 0.875rem; padding: 1rem; margin-bottom: 1.25rem;">
            <div id="comment-preview-avatar" style="width: 2.75rem; height: 2.75rem; border-radius: 50%; background: linear-gradient(135deg,#475569,#334155); display: flex; align-items: center; justify-content: center; font-size: 0.9rem; font-weight: 700; color: white; flex-shrink: 0; overflow: hidden;">
                ?
            </div>
            <div style="min-width: 0; flex: 1;">
                <p id="comment-preview-name" style="font-size: 0.9rem; font-weight: 700; color: #f8fafc; margin: 0 0 0.35rem;">Nama pengirim</p>
                <p id="comment-preview-body" style="font-size: 0.85rem; line-height: 1.55; color: #cbd5e1; margin: 0; white-space: pre-wrap; word-break: break-word;">Isi komentar akan tampil di sini.</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <button type="button" class="btn-outline" style="flex: 1; justify-content: center; min-width: 9rem;" onclick="closeCommentConfirmModal()">
                Periksa Lagi
            </button>
            <button type="button" class="btn-primary" style="flex: 1; justify-content: center; min-width: 9rem;" onclick="submitCommentForm()">
                Ya, Kirim
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes commentModalPop {
        from { opacity: 0; transform: translateY(10px) scale(0.96); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
</style>

@endsection

@push('scripts')
<script>
    const commentForm = document.getElementById('comment-form');
    const commentConfirmModal = document.getElementById('comment-confirm-modal');
    let shouldSubmitComment = false;

    commentForm?.addEventListener('submit', function (event) {
        if (shouldSubmitComment) return;

        event.preventDefault();
        if (!commentForm.checkValidity()) {
            commentForm.reportValidity();
            return;
        }

        updateCommentPreview();
        if (commentConfirmModal) commentConfirmModal.style.display = 'flex';
    });

    function updateCommentPreview() {
        if (!commentForm) return;

        const name = commentForm.querySelector('[name="name"]')?.value.trim() || 'Pengunjung';
        const body = commentForm.querySelector('[name="body"]')?.value.trim() || 'Isi komentar akan tampil di sini.';
        const avatarFile = commentForm.querySelector('[name="avatar"]')?.files?.[0];
        const avatarEl = document.getElementById('comment-preview-avatar');

        document.getElementById('comment-preview-name').textContent = name;
        document.getElementById('comment-preview-body').textContent = body;

        if (!avatarEl) return;

        if (avatarFile) {
            const reader = new FileReader();
            reader.onload = function (event) {
                avatarEl.innerHTML = `<img src="${event.target.result}" alt="${name}" style="width:100%; height:100%; object-fit:cover;">`;
            };
            reader.readAsDataURL(avatarFile);
        } else {
            avatarEl.textContent = name.charAt(0).toUpperCase();
        }
    }

    function closeCommentConfirmModal() {
        if (commentConfirmModal) commentConfirmModal.style.display = 'none';
    }

    function submitCommentForm() {
        if (!commentForm) return;
        shouldSubmitComment = true;
        commentForm.submit();
    }

    commentConfirmModal?.addEventListener('click', function (event) {
        if (event.target === this) closeCommentConfirmModal();
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeCommentConfirmModal();
    });

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
