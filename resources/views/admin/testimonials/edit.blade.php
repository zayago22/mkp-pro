@extends('admin.layout')

@section('content')
<div class="bg-[#161a24] rounded-lg border border-white/10 p-6">
    <h1 class="text-xl font-semibold mb-6">Editar testimonio</h1>

    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="quote_en" class="block text-sm font-medium mb-1">Quote (EN)</label>
                    <textarea name="quote_en" id="quote_en" rows="4" required
                        class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('quote_en') border-red-500 @enderror"
                        placeholder="Testimonial text (English)">{{ old('quote_en', $testimonial->quote_en) }}</textarea>
                    @error('quote_en')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="quote_es" class="block text-sm font-medium mb-1">Quote (ES)</label>
                    <textarea name="quote_es" id="quote_es" rows="4" required
                        class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('quote_es') border-red-500 @enderror"
                        placeholder="Texto del testimonio">{{ old('quote_es', $testimonial->quote_es) }}</textarea>
                    @error('quote_es')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <label for="author_name" class="block text-sm font-medium mb-1">Nombre del autor</label>
                <input type="text" name="author_name" id="author_name" value="{{ old('author_name', $testimonial->author_name) }}" required
                    class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('author_name') border-red-500 @enderror"
                    placeholder="Ej: Juan Pérez">
                @error('author_name')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="author_title_en" class="block text-sm font-medium mb-1">Título del autor (EN)</label>
                    <input type="text" name="author_title_en" id="author_title_en" value="{{ old('author_title_en', $testimonial->author_title_en) }}"
                        class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('author_title_en') border-red-500 @enderror"
                        placeholder="e.g. CEO, Company X">
                    @error('author_title_en')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="author_title_es" class="block text-sm font-medium mb-1">Título del autor (ES)</label>
                    <input type="text" name="author_title_es" id="author_title_es" value="{{ old('author_title_es', $testimonial->author_title_es) }}"
                        class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('author_title_es') border-red-500 @enderror"
                        placeholder="Ej: CEO, Empresa X">
                    @error('author_title_es')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div>
                <label for="rating" class="block text-sm font-medium mb-1">Rating</label>
                <select name="rating" id="rating" required
                    class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('rating') border-red-500 @enderror">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('rating', $testimonial->rating) == $i ? 'selected' : '' }}>{{ $i }} estrella(s)</option>
                    @endfor
                </select>
                @error('rating')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }}
                        class="rounded border-white/20 bg-[#1a1f2e] text-orange-500 focus:ring-orange-500">
                    <span class="text-sm">Activo</span>
                </label>
                @error('is_active')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mt-6 flex gap-3">
            <button type="submit" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 rounded font-medium">
                Actualizar
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="px-4 py-2 border border-white/20 hover:bg-white/5 rounded font-medium">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
