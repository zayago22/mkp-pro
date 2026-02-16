@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold text-white">Dashboard</h2>
        <p class="text-gray-400 mt-1">Welcome back. Here's an overview of your content.</p>
    </div>

    <!-- Stat cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
        <a href="{{ route('admin.projects.index') }}" class="block group">
            <div class="bg-[#0f1119] border border-white/5 rounded-xl p-6 hover:border-orange-500/30 transition-all duration-200 group-hover:border-orange-500/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Projects</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $projectsCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-orange-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1 mt-4 text-sm text-orange-400 group-hover:text-orange-300 transition-colors">View all
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </div>
        </a>

        <a href="{{ route('admin.testimonials.index') }}" class="block group">
            <div class="bg-[#0f1119] border border-white/5 rounded-xl p-6 hover:border-orange-500/30 transition-all duration-200 group-hover:border-orange-500/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Testimonials</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $testimonialsCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-orange-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1 mt-4 text-sm text-orange-400 group-hover:text-orange-300 transition-colors">View all
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </div>
        </a>

        <a href="{{ route('admin.blog-posts.index') }}" class="block group">
            <div class="bg-[#0f1119] border border-white/5 rounded-xl p-6 hover:border-orange-500/30 transition-all duration-200 group-hover:border-orange-500/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Blog Posts</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $postsCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-orange-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1 mt-4 text-sm text-orange-400 group-hover:text-orange-300 transition-colors">View all
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </div>
        </a>

        <a href="{{ route('admin.social-links.index') }}" class="block group">
            <div class="bg-[#0f1119] border border-white/5 rounded-xl p-6 hover:border-orange-500/30 transition-all duration-200 group-hover:border-orange-500/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Social Links</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $socialLinksCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-orange-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1 mt-4 text-sm text-orange-400 group-hover:text-orange-300 transition-colors">View all
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </div>
        </a>

        <a href="{{ route('admin.messages.index') }}" class="block group">
            <div class="bg-[#0f1119] border border-white/5 rounded-xl p-6 hover:border-orange-500/30 transition-all duration-200 group-hover:border-orange-500/50">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-400">Messages</p>
                        <p class="text-3xl font-bold text-white mt-1">{{ $messagesCount }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-orange-500/20 flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1 mt-4 text-sm text-orange-400 group-hover:text-orange-300 transition-colors">
                    @if($unreadCount > 0) {{ $unreadCount }} unread @else View all @endif
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </span>
            </div>
        </a>
    </div>

    <!-- Quick links -->
    <div class="bg-[#0f1119] border border-white/5 rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Quick actions</h3>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Project
            </a>
            <a href="{{ route('admin.testimonials.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Testimonial
            </a>
            <a href="{{ route('admin.blog-posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Blog Post
            </a>
            <a href="{{ route('admin.blog-categories.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white text-sm font-medium transition-colors border border-white/10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Blog Category
            </a>
            <a href="{{ route('admin.social-links.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/5 hover:bg-white/10 text-gray-300 hover:text-white text-sm font-medium transition-colors border border-white/10">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                New Social Link
            </a>
        </div>
    </div>
</div>
@endsection
