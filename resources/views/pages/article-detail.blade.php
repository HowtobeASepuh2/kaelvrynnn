@extends('layouts.app')
@section('title', ($article->seo_title ?: $article->title) . ' — Wisnu Nugroho')
@section('meta_description', $article->seo_description ?: Str::limit(strip_tags($article->body), 160))

@section('content')
<article class="pt-28 pb-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('articles.index') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition-colors text-sm mb-8"><i class="fas fa-arrow-left"></i> Kembali ke Insights</a>
        <div class="mb-8" data-aos="fade-up">
            <p class="text-cyan-400 text-sm mb-3">{{ $article->published_at?->format('d M Y') }}</p>
            <h1 class="text-3xl sm:text-5xl font-bold text-slate-100 mb-4">{{ $article->title }}</h1>
            @if($article->excerpt)<p class="text-lg text-slate-400 leading-relaxed">{{ $article->excerpt }}</p>@endif
        </div>
        @if($article->cover_image)
        <img src="{{ Storage::url($article->cover_image) }}" alt="{{ $article->title }}" class="w-full max-h-[460px] object-cover rounded-2xl mb-8" loading="lazy">
        @endif
        <div class="glass-card rounded-2xl p-8 text-slate-300 leading-8 whitespace-pre-line">{{ $article->body }}</div>
        @if($related->count())
        <div class="mt-14">
            <h2 class="text-xl font-bold text-slate-100 mb-6">Insight Lainnya</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $item)
                <a href="{{ route('articles.show', $item->slug) }}" class="glass-card rounded-xl p-5 hover:border-cyan-500/30 transition-colors">
                    <p class="text-xs text-cyan-400 mb-2">{{ $item->published_at?->format('d M Y') }}</p>
                    <h3 class="font-semibold text-slate-100">{{ $item->title }}</h3>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</article>
@endsection
