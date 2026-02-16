@extends('admin.layout')

@section('content')
<div class="bg-[#161a24] rounded-lg border border-white/10 p-6">
    <h1 class="text-2xl font-bold text-white mb-6">Editar Post</h1>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-900/30 border border-red-500/50 text-red-300 rounded">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="title_en" class="block text-sm font-medium text-white mb-2">Título (EN)</label>
                <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $blogPost->title_en) }}" required
                    class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
            </div>
            <div>
                <label for="title_es" class="block text-sm font-medium text-white mb-2">Título (ES)</label>
                <input type="text" name="title_es" id="title_es" value="{{ old('title_es', $blogPost->title_es) }}" required
                    class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="excerpt_en" class="block text-sm font-medium text-white mb-2">Resumen (EN)</label>
                <textarea name="excerpt_en" id="excerpt_en" rows="3"
                    class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">{{ old('excerpt_en', $blogPost->excerpt_en) }}</textarea>
            </div>
            <div>
                <label for="excerpt_es" class="block text-sm font-medium text-white mb-2">Resumen (ES)</label>
                <textarea name="excerpt_es" id="excerpt_es" rows="3"
                    class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">{{ old('excerpt_es', $blogPost->excerpt_es) }}</textarea>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="body_en" class="block text-sm font-medium text-white mb-2">Cuerpo (EN)</label>
                <textarea name="body_en" id="body_en" rows="12" required
                    class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">{{ old('body_en', $blogPost->body_en) }}</textarea>
            </div>
            <div>
                <label for="body_es" class="block text-sm font-medium text-white mb-2">Cuerpo (ES)</label>
                <textarea name="body_es" id="body_es" rows="12" required
                    class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">{{ old('body_es', $blogPost->body_es) }}</textarea>
            </div>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-white mb-2">Imagen</label>
            @if($blogPost->image)
            <div class="mb-2">
                <img src="{{ $blogPost->image_url }}" alt="" class="max-w-xs h-auto rounded border border-white/10">
                <p class="text-sm text-gray-400 mt-1">Imagen actual</p>
            </div>
            @endif
            <input type="file" name="image" id="image" accept="image/*"
                class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-orange-500 file:text-white file:cursor-pointer">
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-white mb-2">Categoría</label>
            <select name="category_id" id="category_id"
                class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
                <option value="">— Sin categoría</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id', $blogPost->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-white mb-2">Etiquetas</label>
            @php
                $checkedIds = old('tags', $blogPost->tags->pluck('id')->toArray());
            @endphp
            <div class="space-y-2 flex flex-wrap gap-3">
                @foreach($tags as $tag)
                <label class="inline-flex items-center">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $checkedIds) ? 'checked' : '' }}
                        class="rounded border-white/10 text-orange-500 focus:ring-orange-500">
                    <span class="ml-2 text-white">{{ $tag->name }}</span>
                </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blogPost->is_published) ? 'checked' : '' }}
                    class="rounded border-white/10 text-orange-500 focus:ring-orange-500">
                <span class="ml-2 text-white">Publicar ahora</span>
            </label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium">Actualizar post</button>
            <a href="{{ route('admin.blog-posts.index') }}" class="px-4 py-2 border border-white/10 rounded-lg text-white hover:bg-white/5">Cancelar</a>
        </div>
    </form>
</div>
@endsection
