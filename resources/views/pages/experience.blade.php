@extends('layouts.app')

@section('title', 'Experience — Wisnu Nugroho')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <x-section-header
            tag="Perjalanan"
            title="Pengalaman Saya"
            subtitle="Perjalanan belajar dan berkembang dalam dunia desain grafis dan creative editing"
        />

        {{-- Timeline --}}
        <div class="relative">
            {{-- Vertical Line --}}
            <div class="absolute left-8 top-0 bottom-0 w-px bg-gradient-to-b from-cyan-500/50 via-purple-500/30 to-transparent"></div>

            <div class="space-y-8">
                @foreach($experiences as $index => $exp)
                <div class="relative flex gap-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

                    {{-- Year Dot --}}
                    <div class="flex-shrink-0 relative z-10">
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/20">
                            <span class="text-white text-xs font-bold">{{ $exp->year }}</span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="glass-card rounded-xl p-6 flex-1 hover:border-cyan-500/30 transition-all duration-300 group">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-semibold text-slate-100 text-lg group-hover:text-cyan-400 transition-colors">
                                {{ $exp->title }}
                            </h3>
                            <span class="text-xs text-cyan-400 font-medium bg-cyan-500/10 px-2 py-1 rounded-full border border-cyan-500/20 ml-3 flex-shrink-0">
                                {{ $exp->year }}
                            </span>
                        </div>
                        <p class="text-slate-400 text-sm leading-relaxed">{{ $exp->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- CTA --}}
        <div class="mt-16 text-center" data-aos="fade-up">
            <p class="text-slate-400 mb-6">Tertarik untuk berkolaborasi?</p>
            <a href="{{ route('contact') }}" class="btn-primary">
                <i class="fas fa-handshake mr-2"></i>Mari Bekerja Sama
            </a>
        </div>

    </div>
</div>
@endsection