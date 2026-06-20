@extends('layouts.app')
@section('title', 'Insights — Wisnu Nugroho')
@section('meta_description', 'Catatan proses, studi kasus, dan insight desain dari Wisnu Nugroho.')

@section('content')
<div class="pt-28 pb-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header tag="Insights" title="Catatan & Studi Kasus" subtitle="Proses, pembelajaran, dan cerita di balik karya kreatif saya." />
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($articles as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="glass-card rounded-2xl overflow-hidden group hover:border-cyan-500/30 transition-colors">
                @if($article->cover_image)
                <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" class="w-full h-44 object-cover group-hover:scale-105 transition-transform" loading="lazy">
                @endif
                <div class="p-6">
                    <p class="text-xs text-cyan-400 mb-3">{{ $article->published_at?->format('d M Y') }}</p>
                    <h2 class="text-xl font-bold text-slate-100 mb-3">{{ $article->title }}</h2>
                    <p class="text-slate-400 text-sm leading-relaxed">{{ $article->excerpt ?: Str::limit(strip_tags($article->body), 130) }}</p>
                </div>
            </a>
            @empty
            <div class="glass-card rounded-2xl p-8 text-center text-slate-400 md:col-span-3">Belum ada insight yang dipublikasikan.</div>
            @endforelse
        </div>
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</div>
@endsection
