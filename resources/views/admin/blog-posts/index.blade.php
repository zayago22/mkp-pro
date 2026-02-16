@extends('admin.layout')

@section('content')
<div class="bg-[#161a24] rounded-lg border border-white/10 p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Blog Posts</h1>
        <a href="{{ route('admin.blog-posts.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium">Nuevo post</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-white/10">
            <thead>
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-white">Título</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-white">Categoría</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-white">Publicado</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-white">Fecha</th>
                    <th class="px-4 py-3 text-right text-sm font-semibold text-white">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr class="border-t border-white/10">
                    <td class="px-4 py-3 text-white font-medium">{{ $post->title }}</td>
                    <td class="px-4 py-3 text-white">{{ $post->category?->name ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded {{ $post->is_published ? 'bg-green-600/50 text-green-300 border border-green-500/50' : 'bg-gray-600/50 text-gray-400 border border-white/10' }}">
                            {{ $post->is_published ? 'Publicado' : 'Borrador' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-white">{{ $post->published_at?->format('d/m/Y') ?? '—' }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('admin.blog-posts.edit', $post) }}" class="text-orange-500 hover:text-orange-400 mr-2">Editar</a>
                        <form action="{{ route('admin.blog-posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este post?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-400">No hay posts. <a href="{{ route('admin.blog-posts.create') }}" class="text-orange-500 hover:underline">Crear el primero</a></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
