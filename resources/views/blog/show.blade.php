@extends('layouts.public')

@section('title', $post->t('title') . ' - ' . __('blog.title') . ' - Mobile Kitchen Pro')

@section('content')

<article class="py-24 px-6">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('blog.index') }}" class="text-orange-500 text-sm hover:underline">&larr; {{ __('blog.back') }}</a>
        </div>

        @if($post->image)
        <div class="aspect-video rounded-xl overflow-hidden mb-8">
            <img src="{{ $post->image_url }}" alt="{{ $post->t('title') }}" class="w-full h-full object-cover">
        </div>
        @endif

        <div class="flex items-center gap-3 mb-4 text-sm text-gray-400">
            @if($post->category)
            <span class="text-orange-500 font-semibold uppercase text-xs">{{ $post->category->t('name') }}</span>
            <span>&middot;</span>
            @endif
            <span>{{ $post->published_at?->format('F d, Y') }}</span>
        </div>

        <h1 class="text-3xl md:text-4xl font-bold text-white mb-6">{{ $post->t('title') }}</h1>

        @if($post->tags->count())
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach($post->tags as $tag)
            <span class="bg-white/5 border border-white/10 text-gray-400 px-3 py-1 rounded-full text-xs">{{ $tag->name }}</span>
            @endforeach
        </div>
        @endif

        <div class="prose prose-invert prose-orange max-w-none text-gray-300 leading-relaxed">
            {!! nl2br(e($post->t('body'))) !!}
        </div>

        @if($related->count())
        <div class="mt-16 pt-12 border-t border-white/10">
            <h3 class="text-xl font-bold text-white mb-8">{{ __('blog.related') }}</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($related as $r)
                <a href="{{ route('blog.show', $r->slug) }}" class="bg-[#161a24] border border-white/5 rounded-xl overflow-hidden group hover:border-orange-500/30 transition">
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ $r->image_url }}" alt="{{ $r->t('title') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    </div>
                    <div class="p-4">
                        <h4 class="text-white font-semibold group-hover:text-orange-400 transition">{{ $r->t('title') }}</h4>
                        <p class="text-gray-400 text-xs mt-1">{{ $r->published_at?->format('M d, Y') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</article>

@endsection
