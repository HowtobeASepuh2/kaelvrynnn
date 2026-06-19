<footer class="bg-[#0a0e1a] border-t border-white/5 mt-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Brand --}}
            <div>
                <span class="text-2xl font-bold gradient-text">WN.</span>
                <p class="mt-3 text-slate-400 text-sm leading-relaxed">
                    Graphic Designer & Creative Editor.<br>
                    Designing visuals that speak, move, and connect.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-sm font-semibold text-slate-200 uppercase tracking-wider mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    @foreach([
                        ['home', 'Home'],
                        ['about', 'About'],
                        ['projects.index', 'Projects'],
                        ['contact', 'Contact'],
                    ] as [$route, $label])
                    <li>
                        <a href="{{ route($route) }}" class="text-slate-400 hover:text-cyan-400 text-sm transition-colors">
                            {{ $label }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Social Links --}}
            <div>
                <h3 class="text-sm font-semibold text-slate-200 uppercase tracking-wider mb-4">Find Me</h3>
                <div class="flex gap-3">
                    @php $profile = \App\Models\Profile::first(); @endphp
                    @if($profile)
                        @if($profile->instagram)
                        <a href="{{ $profile->instagram }}" target="_blank"
                           class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-pink-400 hover:border-pink-400/30 transition-all">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                        @endif
                        @if($profile->github)
                        <a href="{{ $profile->github }}" target="_blank"
                           class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-slate-200 hover:border-slate-400/30 transition-all">
                            <i class="fab fa-github text-sm"></i>
                        </a>
                        @endif
                        @if($profile->linkedin)
                        <a href="{{ $profile->linkedin }}" target="_blank"
                           class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-blue-400 hover:border-blue-400/30 transition-all">
                            <i class="fab fa-linkedin text-sm"></i>
                        </a>
                        @endif
                        @if($profile->whatsapp)
                        <a href="{{ $profile->whatsapp }}" target="_blank"
                           class="w-9 h-9 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-400 hover:text-green-400 hover:border-green-400/30 transition-all">
                            <i class="fab fa-whatsapp text-sm"></i>
                        </a>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-10 pt-6 border-t border-white/5 flex flex-col sm:flex-row justify-between items-center gap-3">
            <p class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} Wisnu Nugroho. All rights reserved.
            </p>
            <p class="text-slate-500 text-sm">
                Built with <span class="text-red-400">♥</span> using Laravel & Tailwind CSS
            </p>
        </div>
    </div>
</footer>