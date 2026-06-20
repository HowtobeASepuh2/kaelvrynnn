@extends('layouts.app')

@section('title', 'Services — Wisnu Nugroho')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <x-section-header
            tag="Layanan"
            title="Yang Bisa Saya Bantu"
            subtitle="Jasa desain dan editing yang tersedia untuk kebutuhan personal maupun profesional"
        />

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['fa-palette', 'Desain Poster', 'Poster event, promosi, seminar, lomba, dan kebutuhan kampus maupun organisasi.', 'Canva, Photoshop'],
                ['fa-instagram', 'Desain Feed Instagram', 'Konten feed Instagram yang konsisten, estetik, dan sesuai identitas brand.', 'Canva, PixelLab'],
                ['fa-presentation-screen', 'Desain Presentasi', 'Slide presentasi profesional, menarik, dan mudah dipahami.', 'Canva, Figma'],
                ['fa-video', 'Editing Video Pendek', 'Video reels, TikTok, promosi, dan konten media sosial.', 'CapCut, Alight Motion'],
                ['fa-mobile-screen', 'Desain UI Website/App', 'Rancangan tampilan UI website atau aplikasi berbasis Figma.', 'Figma, Adobe XD'],
                ['fa-tag', 'Branding Visual', 'Logo sederhana, color palette, dan identitas visual brand dasar.', 'Canva, Photoshop'],
            ] as [$icon, $title, $desc, $tools])
            <div class="glass-card rounded-xl p-6 hover:border-cyan-500/30 transition-all duration-300 hover:-translate-y-1 group" data-aos="fade-up">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500/20 to-purple-500/20 border border-white/10 flex items-center justify-center mb-4 group-hover:border-cyan-500/30 transition-colors">
                    <i class="fas {{ $icon }} text-cyan-400"></i>
                </div>
                <h3 class="font-semibold text-slate-100 mb-2">{{ $title }}</h3>
                <p class="text-slate-400 text-sm leading-relaxed mb-4">{{ $desc }}</p>
                <p class="text-xs text-slate-500">
                    <i class="fas fa-wrench mr-1"></i>{{ $tools }}
                </p>
            </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div class="mt-16 text-center" data-aos="fade-up">
            <div class="glass-card rounded-2xl p-10 max-w-2xl mx-auto">
                <h2 class="text-2xl font-bold mb-3">Tertarik Menggunakan Jasa Saya?</h2>
                <p class="text-slate-400 mb-6">Hubungi saya untuk diskusi kebutuhan dan estimasi pengerjaan.</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="btn-primary">
                        <i class="fas fa-envelope mr-2"></i>Kirim Pesan
                    </a>
                    @if($profile && $profile->whatsapp)
                    <a href="{{ $profile->whatsapp }}" target="_blank" rel="noopener noreferrer" class="btn-outline">
                        <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
