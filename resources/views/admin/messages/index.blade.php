@extends('admin.layout')

@section('title', 'Messages')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-white">Contact Messages</h2>
    <span class="text-gray-400 text-sm">{{ $messages->where('is_read', false)->count() }} unread</span>
</div>

@if(session('success'))
<div class="mb-4 p-4 bg-green-900/50 border border-green-700 rounded-lg text-green-300 text-sm">{{ session('success') }}</div>
@endif

<div class="bg-[#161a24] border border-white/5 rounded-xl overflow-hidden">
    <table class="w-full text-left">
        <thead class="border-b border-white/5">
            <tr>
                <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase"></th>
                <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase">Name</th>
                <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase hidden md:table-cell">Email</th>
                <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase hidden lg:table-cell">Phone</th>
                <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase hidden md:table-cell">Date</th>
                <th class="px-6 py-4 text-xs font-medium text-gray-400 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/5">
            @forelse($messages as $msg)
            <tr class="{{ !$msg->is_read ? 'bg-orange-500/5' : '' }} hover:bg-white/5 transition">
                <td class="px-6 py-4">
                    @if(!$msg->is_read)
                    <span class="inline-block w-2.5 h-2.5 bg-orange-500 rounded-full" title="Unread"></span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <p class="text-white font-medium {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</p>
                    <p class="text-gray-500 text-xs mt-0.5 md:hidden">{{ $msg->email }}</p>
                </td>
                <td class="px-6 py-4 text-gray-300 text-sm hidden md:table-cell">{{ $msg->email }}</td>
                <td class="px-6 py-4 text-gray-300 text-sm hidden lg:table-cell">{{ $msg->phone }}</td>
                <td class="px-6 py-4 text-gray-400 text-sm hidden md:table-cell">{{ $msg->created_at->format('M d, Y H:i') }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.messages.show', $msg) }}" class="text-orange-400 hover:text-orange-300 text-sm font-medium">View</a>
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Delete this message?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 text-sm font-medium">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-gray-500">No messages yet.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
