@extends('layouts.public')

@section('title', __('blog.page_title'))

@section('content')

<section class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="inline-block text-orange-500 font-semibold text-sm tracking-widest uppercase mb-2">{{ __('blog.title') }}</span>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ __('blog.heading') }}</h1>
            <div class="w-16 h-1 bg-orange-500 mx-auto mb-6"></div>
        </div>

        @if($categories->count())
        <div class="flex flex-wrap justify-center gap-2 mb-12">
            <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ !request('category') ? 'bg-orange-500 text-white' : 'bg-[#161a24] text-gray-400 border border-white/5 hover:text-white' }}">{{ __('blog.all') }}</a>
            @foreach($categories as $cat)
            <a href="{{ route('blog.index', ['category' => $cat->slug]) }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request('category') === $cat->slug ? 'bg-orange-500 text-white' : 'bg-[#161a24] text-gray-400 border border-white/5 hover:text-white' }}">
                {{ $cat->t('name') }} ({{ $cat->posts_count }})
            </a>
            @endforeach
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <a href="{{ route('blog.show', $post->slug) }}" class="bg-[#161a24] border border-white/5 rounded-xl overflow-hidden group hover:border-orange-500/30 transition">
                <div class="aspect-video overflow-hidden">
                    <img src="{{ $post->image_url }}" alt="{{ $post->t('title') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                </div>
                <div class="p-6">
                    @if($post->category)
                    <span class="text-orange-500 text-xs font-semibold uppercase">{{ $post->category->t('name') }}</span>
                    @endif
                    <h2 class="text-lg font-bold text-white mt-1 mb-2 group-hover:text-orange-400 transition">{{ $post->t('title') }}</h2>
                    <p class="text-gray-400 text-sm mb-3">{{ Str::limit($post->t('excerpt') ?? strip_tags($post->t('body')), 120) }}</p>
                    <div class="flex items-center gap-2 text-xs text-gray-500">
                        <span>{{ $post->published_at?->format('M d, Y') }}</span>
                        @if($post->tags->count())
                        <span>&middot;</span>
                        @foreach($post->tags->take(2) as $tag)
                        <span class="bg-white/5 px-2 py-0.5 rounded">{{ $tag->name }}</span>
                        @endforeach
                        @endif
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center text-gray-400 py-12">
                <p class="text-lg">{{ __('blog.no_posts') }}</p>
                <p class="text-sm mt-2">{{ __('blog.no_posts_sub') }}</p>
            </div>
            @endforelse
        </div>

        @if($posts->hasPages())
        <div class="mt-12">{{ $posts->links() }}</div>
        @endif
    </div>
</section>

@endsection
