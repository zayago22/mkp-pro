@extends('admin.layout')

@section('content')
<div class="bg-[#161a24] rounded-lg border border-white/10 overflow-hidden">
    <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
        <h1 class="text-xl font-semibold">Redes sociales</h1>
        <a href="{{ route('admin.social-links.create') }}" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 rounded font-medium">
            Crear enlace
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/10 text-left">
                    <th class="px-6 py-4 font-medium">Plataforma</th>
                    <th class="px-6 py-4 font-medium">URL</th>
                    <th class="px-6 py-4 font-medium">Activo</th>
                    <th class="px-6 py-4 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($links as $link)
                <tr class="border-b border-white/10 hover:bg-white/5">
                    <td class="px-6 py-4">{{ $link->platform }}</td>
                    <td class="px-6 py-4 max-w-sm truncate" title="{{ $link->url }}">{{ $link->url }}</td>
                    <td class="px-6 py-4">
                        @if($link->is_active)
                            <span class="text-green-400">Sí</span>
                        @else
                            <span class="text-gray-500">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.social-links.edit', $link) }}" class="text-orange-500 hover:text-orange-400">Editar</a>
                        <form action="{{ route('admin.social-links.destroy', $link) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('¿Eliminar este enlace?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">No hay enlaces.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
