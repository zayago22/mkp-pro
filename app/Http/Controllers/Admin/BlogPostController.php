<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')->orderByDesc('created_at')->get();
        return view('admin.blog-posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('admin.blog-posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_es' => 'nullable|string|max:255',
            'excerpt_en' => 'nullable|string|max:500',
            'excerpt_es' => 'nullable|string|max:500',
            'body_en' => 'required|string',
            'body_es' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'category_id' => 'nullable|exists:blog_categories,id',
            'is_published' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
        ]);

        $data['title'] = $data['title_en'];
        $data['excerpt'] = $data['excerpt_en'] ?? null;
        $data['body'] = $data['body_en'];
        $data['slug'] = Str::slug($data['title_en']);
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published']) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $post = BlogPost::create($data);
        if (!empty($data['tags'])) {
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post created.');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();
        return view('admin.blog-posts.edit', compact('blogPost', 'categories', 'tags'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $data = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_es' => 'nullable|string|max:255',
            'excerpt_en' => 'nullable|string|max:500',
            'excerpt_es' => 'nullable|string|max:500',
            'body_en' => 'required|string',
            'body_es' => 'nullable|string',
            'image' => 'nullable|image|max:5120',
            'category_id' => 'nullable|exists:blog_categories,id',
            'is_published' => 'boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
        ]);

        $data['title'] = $data['title_en'];
        $data['excerpt'] = $data['excerpt_en'] ?? null;
        $data['body'] = $data['body_en'];
        $data['slug'] = Str::slug($data['title_en']);
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && !$blogPost->published_at) {
            $data['published_at'] = now();
        }
        if ($request->hasFile('image')) {
            if ($blogPost->image) {
                Storage::disk('public')->delete($blogPost->image);
            }
            $data['image'] = $request->file('image')->store('blog', 'public');
        }

        $blogPost->update($data);
        $blogPost->tags()->sync($data['tags'] ?? []);

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post updated.');
    }

    public function destroy(BlogPost $blogPost)
    {
        if ($blogPost->image) {
            Storage::disk('public')->delete($blogPost->image);
        }
        $blogPost->delete();
        return redirect()->route('admin.blog-posts.index')->with('success', 'Post deleted.');
    }
}
