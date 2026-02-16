@extends('admin.layout')

@section('content')
<div class="bg-[#161a24] rounded-lg border border-white/10 p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Categorías del Blog</h1>
        <a href="{{ route('admin.blog-categories.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium">Nueva categoría</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-white/10">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-white">Nombre</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-white">Slug</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-white">Posts</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="border-t border-white/10">
                    <td class="px-4 py-3 text-white font-medium">{{ $category->name }}</td>
                    <td class="px-4 py-3 text-gray-400">{{ $category->slug }}</td>
                    <td class="px-4 py-3 text-white">{{ $category->posts_count }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.blog-categories.edit', $category) }}" class="text-orange-500 hover:text-orange-400 mr-2">Editar</a>
                        <form action="{{ route('admin.blog-categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta categoría?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-8 text-center text-gray-400">No hay categorías. <a href="{{ route('admin.blog-categories.create') }}" class="text-orange-500 hover:underline">Crear la primera</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
