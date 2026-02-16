@extends('admin.layout')

@section('content')
<div class="bg-[#161a24] rounded-lg border border-white/10 overflow-hidden">
    <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
        <h1 class="text-xl font-semibold">Testimonios</h1>
        <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2 bg-orange-500 hover:bg-orange-600 rounded font-medium">
            Crear testimonio
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/10 text-left">
                    <th class="px-6 py-4 font-medium">Quote</th>
                    <th class="px-6 py-4 font-medium">Autor</th>
                    <th class="px-6 py-4 font-medium">Rating</th>
                    <th class="px-6 py-4 font-medium">Activo</th>
                    <th class="px-6 py-4 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr class="border-b border-white/10 hover:bg-white/5">
                    <td class="px-6 py-4 max-w-xs truncate" title="{{ $t->quote }}">{{ Str::limit($t->quote, 60) }}</td>
                    <td class="px-6 py-4">{{ $t->author_name }}</td>
                    <td class="px-6 py-4">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="text-orange-500">{{ $i <= $t->rating ? '★' : '☆' }}</span>
                        @endfor
                        <span class="text-gray-400 text-sm ml-1">({{ $t->rating }}/5)</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($t->is_active)
                            <span class="text-green-400">Sí</span>
                        @else
                            <span class="text-gray-500">No</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.testimonials.edit', $t) }}" class="text-orange-500 hover:text-orange-400">Editar</a>
                        <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('¿Eliminar este testimonio?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-400">No hay testimonios.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
