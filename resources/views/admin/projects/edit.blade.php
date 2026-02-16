@extends('admin.layout')

@section('content')
<div class="rounded-lg border border-white/10 bg-[#161a24] p-6">
    <h1 class="mb-6 text-2xl font-bold text-white">Editar proyecto</h1>

    @if($errors->any())
    <div class="mb-6 rounded-lg border border-red-500/50 bg-red-900/20 p-4 text-red-200">
        <ul class="list-inside list-disc space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="title_en" class="mb-2 block text-sm font-medium text-gray-200">Title (EN)</label>
                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en', $project->title_en) }}"
                        class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-white placeholder-gray-500 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500">
                </div>
                <div>
                    <label for="title_es" class="mb-2 block text-sm font-medium text-gray-200">Title (ES)</label>
                    <input type="text" name="title_es" id="title_es" value="{{ old('title_es', $project->title_es) }}"
                        class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-white placeholder-gray-500 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500">
                </div>
            </div>

            <div>
                <label for="category" class="mb-2 block text-sm font-medium text-gray-200">Categoría</label>
                <select name="category" id="category"
                    class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-white focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500">
                    <option value="food_truck" {{ old('category', $project->category) === 'food_truck' ? 'selected' : '' }}>Food Truck</option>
                    <option value="mobile_kitchen" {{ old('category', $project->category) === 'mobile_kitchen' ? 'selected' : '' }}>Mobile Kitchen</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="short_description_en" class="mb-2 block text-sm font-medium text-gray-200">Short description (EN)</label>
                    <textarea name="short_description_en" id="short_description_en" rows="3"
                        class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-white placeholder-gray-500 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500">{{ old('short_description_en', $project->short_description_en) }}</textarea>
                </div>
                <div>
                    <label for="short_description_es" class="mb-2 block text-sm font-medium text-gray-200">Short description (ES)</label>
                    <textarea name="short_description_es" id="short_description_es" rows="3"
                        class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-white placeholder-gray-500 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500">{{ old('short_description_es', $project->short_description_es) }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="description_en" class="mb-2 block text-sm font-medium text-gray-200">Description (EN)</label>
                    <textarea name="description_en" id="description_en" rows="6"
                        class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-white placeholder-gray-500 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500">{{ old('description_en', $project->description_en) }}</textarea>
                </div>
                <div>
                    <label for="description_es" class="mb-2 block text-sm font-medium text-gray-200">Description (ES)</label>
                    <textarea name="description_es" id="description_es" rows="6"
                        class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-white placeholder-gray-500 focus:border-orange-500 focus:outline-none focus:ring-1 focus:ring-orange-500">{{ old('description_es', $project->description_es) }}</textarea>
                </div>
            </div>

            <div>
                <label for="image" class="mb-2 block text-sm font-medium text-gray-200">Imagen principal</label>
                @if($project->image)
                <div class="mb-3">
                    <p class="mb-2 text-sm text-gray-400">Imagen actual:</p>
                    <img src="{{ $project->image_url }}" alt="" class="h-24 w-32 rounded object-cover">
                </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                    class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-gray-300 file:mr-4 file:rounded file:border-0 file:bg-orange-500 file:px-4 file:py-2 file:text-white file:hover:bg-orange-600">
                @if($project->image)
                <p class="mt-1 text-xs text-gray-500">Dejar vacío para mantener la imagen actual</p>
                @endif
            </div>

            <div>
                <label class="mb-2 block text-sm font-medium text-gray-200">Imágenes del slider</label>
                @if($project->sliderImages->isNotEmpty())
                <div class="mb-4 flex flex-wrap gap-4">
                    @foreach($project->sliderImages as $img)
                    <div class="group relative">
                        <img src="{{ $img->image_url }}" alt="" class="h-20 w-28 rounded object-cover">
                        <form action="{{ route('admin.projects.slider-image.destroy', $img) }}" method="POST" class="absolute -right-2 -top-2" onsubmit="return confirm('¿Eliminar esta imagen?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full bg-red-500 p-1.5 text-white opacity-80 hover:bg-red-600 hover:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @endif
                <input type="file" name="slider_images[]" id="slider_images" accept="image/*" multiple
                    class="w-full rounded-lg border border-white/10 bg-white/5 px-4 py-2 text-gray-300 file:mr-4 file:rounded file:border-0 file:bg-orange-500 file:px-4 file:py-2 file:text-white file:hover:bg-orange-600">
                <p class="mt-1 text-xs text-gray-500">Agregar más imágenes al slider</p>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}
                    class="h-4 w-4 rounded border-white/10 bg-white/5 text-orange-500 focus:ring-orange-500">
                <label for="is_active" class="text-sm font-medium text-gray-200">Activo</label>
            </div>
        </div>

        <div class="mt-8 flex gap-4">
            <button type="submit" class="rounded-lg bg-orange-500 px-6 py-2 font-medium text-white transition hover:bg-orange-600">
                Guardar cambios
            </button>
            <a href="{{ route('admin.projects.index') }}" class="rounded-lg border border-white/10 bg-white/5 px-6 py-2 font-medium text-white transition hover:bg-white/10">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
