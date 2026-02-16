@extends('admin.layout')

@section('content')
<div class="bg-[#161a24] rounded-lg border border-white/10 p-6">
    <h1 class="text-xl font-semibold mb-6">Editar enlace social</h1>

    <form action="{{ route('admin.social-links.update', $socialLink) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="space-y-4">
            <div>
                <label for="platform" class="block text-sm font-medium mb-1">Plataforma</label>
                <input type="text" name="platform" id="platform" value="{{ old('platform', $socialLink->platform) }}" required
                    class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('platform') border-red-500 @enderror"
                    placeholder="Ej: Facebook, Twitter, LinkedIn">
                @error('platform')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="url" class="block text-sm font-medium mb-1">URL</label>
                <input type="url" name="url" id="url" value="{{ old('url', $socialLink->url) }}" required
                    class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('url') border-red-500 @enderror"
                    placeholder="https://...">
                @error('url')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="icon" class="block text-sm font-medium mb-1">Icono (opcional)</label>
                <input type="text" name="icon" id="icon" value="{{ old('icon', $socialLink->icon) }}"
                    class="w-full px-4 py-2 bg-[#1a1f2e] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500 @error('icon') border-red-500 @enderror"
                    placeholder="Ej: fab fa-facebook">
                @error('icon')
                    <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $socialLink->is_active) ? 'checked' : '' }}
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
            <a href="{{ route('admin.social-links.index') }}" class="px-4 py-2 border border-white/20 hover:bg-white/5 rounded font-medium">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
