@extends('admin.layout')

@section('title', 'Message from ' . $message->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.messages.index') }}" class="text-orange-400 hover:text-orange-300 text-sm">&larr; Back to Messages</a>
</div>

<div class="bg-[#161a24] border border-white/5 rounded-xl p-6 sm:p-8 max-w-3xl">
    <div class="flex items-start justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-white">{{ $message->name }}</h2>
            <p class="text-gray-400 text-sm mt-1">{{ $message->created_at->format('F d, Y \a\t h:i A') }}</p>
        </div>
        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Delete this message?')">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Delete</button>
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
        <div>
            <p class="text-gray-500 text-xs uppercase font-medium mb-1">Email</p>
            <a href="mailto:{{ $message->email }}" class="text-orange-400 hover:underline">{{ $message->email }}</a>
        </div>
        <div>
            <p class="text-gray-500 text-xs uppercase font-medium mb-1">Phone</p>
            <a href="tel:{{ $message->phone }}" class="text-orange-400 hover:underline">{{ $message->phone }}</a>
        </div>
    </div>

    @if($message->message)
    <div>
        <p class="text-gray-500 text-xs uppercase font-medium mb-2">Message</p>
        <div class="bg-[#0f1119] border border-white/5 rounded-lg p-4 text-gray-300 text-sm leading-relaxed whitespace-pre-wrap">{{ $message->message }}</div>
    </div>
    @endif
</div>
@endsection
