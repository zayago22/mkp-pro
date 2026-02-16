@extends('admin.layout')

@section('content')
<div class="bg-[#161a24] rounded-lg border border-white/10 p-6">
    <h1 class="text-2xl font-bold text-white mb-6">Editar Categoría</h1>

    @if($errors->any())
    <div class="mb-6 p-4 bg-red-900/30 border border-red-500/50 text-red-300 rounded">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.blog-categories.update', $blogCategory) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name_en" class="block text-sm font-medium text-white mb-2">Nombre (EN)</label>
                <input type="text" name="name_en" id="name_en" value="{{ old('name_en', $blogCategory->name_en) }}" required
                    class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
            </div>
            <div>
                <label for="name_es" class="block text-sm font-medium text-white mb-2">Nombre (ES)</label>
                <input type="text" name="name_es" id="name_es" value="{{ old('name_es', $blogCategory->name_es) }}" required
                    class="w-full px-4 py-2 bg-[#161a24] border border-white/10 rounded text-white placeholder-gray-500 focus:border-orange-500 focus:ring-1 focus:ring-orange-500">
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium">Actualizar categoría</button>
            <a href="{{ route('admin.blog-categories.index') }}" class="px-4 py-2 border border-white/10 rounded-lg text-white hover:bg-white/5">Cancelar</a>
        </div>
    </form>
</div>
@endsection
