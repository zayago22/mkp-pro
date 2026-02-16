<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\SocialLink;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()
            ->with('category', 'tags')
            ->orderByDesc('published_at')
            ->paginate(9);

        $categories = BlogCategory::withCount(['posts' => fn ($q) => $q->published()])->get();
        $tags = BlogTag::has('posts')->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('blog.index', compact('posts', 'categories', 'tags', 'socialLinks'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->with('category', 'tags')->firstOrFail();
        $related = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->limit(3)->get();
        $socialLinks = SocialLink::where('is_active', true)->orderBy('order')->get();

        return view('blog.show', compact('post', 'related', 'socialLinks'));
    }
}
