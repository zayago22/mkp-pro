@extends('admin.layout')

@section('content')
<div class="rounded-lg border border-white/10 bg-[#161a24] p-6">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-white">Proyectos</h1>
        <a href="{{ route('admin.projects.create') }}" class="rounded-lg bg-orange-500 px-4 py-2 font-medium text-white transition hover:bg-orange-600">
            Nuevo proyecto
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="border-b border-white/10 text-sm text-gray-400">
                <tr>
                    <th class="pb-3 font-medium">Título</th>
                    <th class="pb-3 font-medium">Categoría</th>
                    <th class="pb-3 font-medium">Imagen</th>
                    <th class="pb-3 font-medium">Activo</th>
                    <th class="pb-3 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse($projects as $project)
                <tr class="text-white">
                    <td class="py-4 font-medium">{{ $project->title }}</td>
                    <td class="py-4">{{ $project->category === 'food_truck' ? 'Food Truck' : 'Mobile Kitchen' }}</td>
                    <td class="py-4">
                        @if($project->image)
                        <img src="{{ $project->image_url }}" alt="" class="h-12 w-16 rounded object-cover">
                        @else
                        <span class="text-gray-500">—</span>
                        @endif
                    </td>
                    <td class="py-4">
                        @if($project->is_active)
                        <span class="rounded bg-green-900/50 px-2 py-1 text-xs text-green-200">Sí</span>
                        @else
                        <span class="rounded bg-gray-700 px-2 py-1 text-xs text-gray-400">No</span>
                        @endif
                    </td>
                    <td class="py-4 text-right">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="mr-3 text-orange-500 hover:text-orange-400">Editar</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar este proyecto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-8 text-center text-gray-500">
                        No hay proyectos. <a href="{{ route('admin.projects.create') }}" class="text-orange-500 hover:underline">Crear el primero</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
