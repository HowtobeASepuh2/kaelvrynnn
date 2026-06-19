@props(['skill'])

@php
$levelMap = ['Beginner' => 25, 'Intermediate' => 60, 'Advanced' => 85, 'Expert' => 100];
$levelColor = ['Beginner' => 'from-slate-500 to-slate-400', 'Intermediate' => 'from-blue-500 to-cyan-400', 'Advanced' => 'from-cyan-500 to-purple-500', 'Expert' => 'from-purple-500 to-pink-500'];
$percent = $levelMap[$skill->level] ?? 50;
$color = $levelColor[$skill->level] ?? 'from-cyan-500 to-purple-500';
@endphp

<div
    class="glass-card rounded-xl p-5 hover:border-cyan-500/30 transition-all duration-300 hover:-translate-y-1 group"
    data-aos="fade-up"
>
    <div class="flex items-start gap-4">
        {{-- Icon --}}
        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500/20 to-purple-500/20 border border-white/10 flex items-center justify-center flex-shrink-0 group-hover:border-cyan-500/30 transition-colors">
            <span class="text-xl font-bold gradient-text">{{ strtoupper(substr($skill->name, 0, 2)) }}</span>
        </div>

        <div class="flex-1 min-w-0">
            <div class="flex items-center justify-between mb-1">
                <h3 class="font-semibold text-slate-100 text-sm">{{ $skill->name }}</h3>
                <span class="text-xs text-cyan-400 font-medium">{{ $skill->level }}</span>
            </div>
            <p class="text-xs text-slate-400 mb-3 leading-relaxed line-clamp-2">
                {{ $skill->description }}
            </p>

            {{-- Progress Bar --}}
            <div class="w-full bg-white/5 rounded-full h-1.5">
                <div
                    class="h-1.5 rounded-full bg-gradient-to-r {{ $color }} transition-all duration-1000"
                    style="width: {{ $percent }}%"
                ></div>
            </div>
        </div>
    </div>
</div>