@extends('layouts.app')

@section('title', 'Contact — Wisnu Nugroho')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        <x-section-header
            tag="Kontak"
            title="Hubungi Saya"
            subtitle="Ada project menarik atau ingin berkolaborasi? Jangan ragu untuk menghubungi saya!"
        />

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            {{-- Contact Info --}}
            <div class="lg:col-span-2 space-y-4" data-aos="fade-right">

                @foreach([
                    ['fa-envelope', 'Email', $profile->email ?? 'wisnu@email.com', 'mailto:' . ($profile->email ?? '#')],
                    ['fa-phone', 'WhatsApp', $profile->phone ?? '+62 812-3456-7890', $profile->whatsapp ?? '#'],
                    ['fa-map-marker-alt', 'Lokasi', 'Jambi, Indonesia', null],
                ] as [$icon, $label, $value, $link])
                <div class="glass-card rounded-xl p-5 flex items-center gap-4 hover:border-cyan-500/30 transition-colors">
                    <div class="w-11 h-11 rounded-xl bg-cyan-500/10 flex items-center justify-center flex-shrink-0">
                        <i class="fas {{ $icon }} text-cyan-400"></i>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 mb-0.5">{{ $label }}</p>
                        @if($link)
                            <a href="{{ $link }}" class="text-slate-300 text-sm hover:text-cyan-400 transition-colors">{{ $value }}</a>
                        @else
                            <p class="text-slate-300 text-sm">{{ $value }}</p>
                        @endif
                    </div>
                </div>
                @endforeach

                {{-- Social Media --}}
                <div class="glass-card rounded-xl p-5">
                    <p class="text-xs text-slate-500 uppercase tracking-wider mb-3">Follow Me</p>
                    <div class="flex gap-3">
                        @if($profile && $profile->instagram)
                        <a href="{{ $profile->instagram }}" target="_blank" rel="noopener noreferrer"
                           class="flex-1 py-3 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-pink-400 hover:border-pink-400/30 transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        @endif
                        @if($profile && $profile->github)
                        <a href="{{ $profile->github }}" target="_blank" rel="noopener noreferrer"
                           class="flex-1 py-3 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-white hover:border-white/30 transition-all">
                            <i class="fab fa-github"></i>
                        </a>
                        @endif
                        @if($profile && $profile->linkedin)
                        <a href="{{ $profile->linkedin }}" target="_blank" rel="noopener noreferrer"
                           class="flex-1 py-3 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:border-blue-400/30 transition-all">
                            <i class="fab fa-linkedin"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-3" data-aos="fade-left">
                <div class="glass-card rounded-2xl p-8">

                    @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-3">
                        <i class="fas fa-check-circle text-lg flex-shrink-0"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute; left:-9999px; opacity:0;" aria-hidden="true">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm text-slate-400 mb-2">Nama <span class="text-red-400">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       placeholder="Nama kamu"
                                       class="w-full bg-white/5 border {{ $errors->has('name') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-slate-300 placeholder-slate-600 focus:outline-none focus:border-cyan-500/50 transition-colors text-sm">
                                @error('name')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm text-slate-400 mb-2">Email <span class="text-red-400">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                       placeholder="email@kamu.com"
                                       class="w-full bg-white/5 border {{ $errors->has('email') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-slate-300 placeholder-slate-600 focus:outline-none focus:border-cyan-500/50 transition-colors text-sm">
                                @error('email')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm text-slate-400 mb-2">Subjek <span class="text-red-400">*</span></label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                   placeholder="Topik pesan kamu"
                                   class="w-full bg-white/5 border {{ $errors->has('subject') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-slate-300 placeholder-slate-600 focus:outline-none focus:border-cyan-500/50 transition-colors text-sm">
                            @error('subject')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm text-slate-400 mb-2">Kategori <span class="text-red-400">*</span></label>
                            <select name="category"
                                    class="w-full bg-white/5 border {{ $errors->has('category') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-slate-300 focus:outline-none focus:border-cyan-500/50 transition-colors text-sm">
                                <option value="" class="bg-slate-900">Pilih kategori pesan</option>
                                @foreach(['Kolaborasi', 'Freelance', 'Desain UI/UX', 'Desain Grafis', 'Video Editing', 'Lainnya'] as $category)
                                <option value="{{ $category }}" class="bg-slate-900" {{ old('category') === $category ? 'selected' : '' }}>{{ $category }}</option>
                                @endforeach
                            </select>
                            @error('category')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm text-slate-400 mb-2">Pesan <span class="text-red-400">*</span></label>
                            <textarea name="message" rows="5"
                                      placeholder="Ceritakan project atau keperluanmu..."
                                      class="w-full bg-white/5 border {{ $errors->has('message') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-slate-300 placeholder-slate-600 focus:outline-none focus:border-cyan-500/50 transition-colors text-sm resize-none">{{ old('message') }}</textarea>
                            @error('message')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>

                        <button type="submit" class="btn-primary w-full text-center justify-center flex items-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
