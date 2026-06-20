@extends('layouts.app')

@section('title', 'About — Wisnu Nugroho')
@section('meta_description', 'Kenalan dengan Wisnu Nugroho, mahasiswa Sistem Informasi yang berfokus pada desain grafis, UI/UX, dan video editing.')
@section('meta_keywords', 'About Wisnu Nugroho, Mahasiswa Sistem Informasi, Graphic Designer Jambi')
@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            {{-- Left: Visual --}}
            <div data-aos="fade-right">
                <div class="relative">
                    <div class="glass-card rounded-2xl p-8 text-center">
                        {{-- Avatar --}}
                        <div class="w-32 h-32 mx-auto rounded-2xl mb-6 shadow-xl shadow-purple-500/20 overflow-hidden">
    @if($profile && $profile->photo)
        <img src="{{ Storage::url($profile->photo) }}"
        alt="{{ $profile->name }}"
        class="w-full h-full"
        style="object-fit:cover; object-position:center top;">
    @else
        <div class="w-full h-full bg-gradient-to-br from-cyan-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold">
            {{ strtoupper(substr($profile->name ?? 'WN', 0, 2)) }}
        </div>
    @endif
</div>

                        <h2 class="text-xl font-bold text-slate-100 mb-1">{{ $profile->name ?? 'Wisnu Nugroho' }}</h2>
                        <p class="text-cyan-400 text-sm mb-4">{{ $profile->title ?? 'Graphic Designer & Creative Editor' }}</p>
                        <p class="text-slate-400 text-xs mb-6">Mahasiswa Sistem Informasi · Universitas Jambi</p>

                        {{-- Info Grid --}}
                        <div class="grid grid-cols-2 gap-3 text-left">
                            @foreach([
                                ['fa-envelope', 'Email', $profile->email ?? '-'],
                                ['fa-phone', 'Phone', $profile->phone ?? '-'],
                                ['fa-map-marker-alt', 'Lokasi', 'Jambi, Indonesia'],
                                ['fa-graduation-cap', 'Prodi', 'Sistem Informasi'],
                            ] as [$icon, $label, $value])
                            <div class="bg-white/3 rounded-lg p-3">
                                <p class="text-slate-500 text-xs mb-1">
                                    <i class="fas {{ $icon }} mr-1"></i>{{ $label }}
                                </p>
                                <p class="text-slate-300 text-xs font-medium truncate">{{ $value }}</p>
                            </div>
                            @endforeach
                        </div>

                        {{-- Social --}}
                        <div class="flex justify-center gap-3 mt-6">
                            @if($profile && $profile->instagram)
                            <a href="{{ $profile->instagram }}" target="_blank" rel="noopener noreferrer"
                               class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-pink-400 hover:border-pink-400/30 transition-all">
                                <i class="fab fa-instagram text-sm"></i>
                            </a>
                            @endif
                            @if($profile && $profile->github)
                            <a href="{{ $profile->github }}" target="_blank" rel="noopener noreferrer"
                               class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:border-white/30 transition-all">
                                <i class="fab fa-github text-sm"></i>
                            </a>
                            @endif
                            @if($profile && $profile->linkedin)
                            <a href="{{ $profile->linkedin }}" target="_blank" rel="noopener noreferrer"
                               class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:border-blue-400/30 transition-all">
                                <i class="fab fa-linkedin text-sm"></i>
                            </a>
                            @endif
                        </div>

                        @if($profile && $profile->cv_file)
                        <a href="{{ route('cv.download') }}"
                           class="btn-primary w-full text-center mt-6 block">
                            <i class="fas fa-download mr-2"></i>Download CV
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Right: Text --}}
            <div data-aos="fade-left">
                <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold uppercase tracking-widest bg-cyan-500/10 text-cyan-400 border border-cyan-500/20 mb-4">
                    About Me
                </span>
                <h1 class="text-4xl font-bold mb-6">
                    Saya <span class="gradient-text">Wisnu Nugroho</span>
                </h1>
                <div class="space-y-4 text-slate-400 leading-relaxed">
                    <p>{{ $profile->long_bio ?? 'Saya adalah mahasiswa Sistem Informasi yang memiliki minat kuat pada desain grafis, visual editing, UI/UX, dan content design.' }}</p>
                    <p>Saya terbiasa membuat desain untuk kebutuhan organisasi, media sosial, promosi, presentasi, dan project digital. Bagi saya, desain bukan hanya soal tampilan yang menarik, tetapi juga bagaimana pesan dapat tersampaikan dengan jelas dan efektif.</p>
                    <p>Saat ini saya sedang mengembangkan diri di bidang UI/UX design dan terus memperluas portofolio kreatif untuk mempersiapkan karier sebagai <span class="text-cyan-400 font-medium">Creative Designer</span> profesional.</p>
                </div>

                {{-- What I Do --}}
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach([
                        ['fa-pen-nib', 'Graphic Design', 'Poster, feed, branding visual'],
                        ['fa-vector-square', 'UI/UX Design', 'Wireframe, prototype, Figma'],
                        ['fa-video', 'Video Editing', 'Reels, TikTok, motion text'],
                        ['fa-layer-group', 'Content Design', 'Presentasi, konten digital'],
                    ] as [$icon, $title, $desc])
                    <div class="glass-card rounded-xl p-4 flex items-start gap-3 hover:border-cyan-500/30 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-cyan-500/10 flex items-center justify-center flex-shrink-0">
                            <i class="fas {{ $icon }} text-cyan-400 text-xs"></i>
                        </div>
                        <div>
                            <p class="text-slate-200 text-sm font-medium">{{ $title }}</p>
                            <p class="text-slate-500 text-xs">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="flex gap-4 mt-8">
                    <a href="{{ route('projects.index') }}" class="btn-primary">
                        Lihat Project <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline">
                        Hubungi Saya
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
