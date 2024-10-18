@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-4">Notifikasi</h1>
    @forelse ($notifications as $notification)
        <div class="bg-white shadow-md rounded-lg p-4 mb-4 {{ $notification->read ? 'opacity-50' : '' }}">
            <p class="font-semibold">{{ $notification->message }}</p>
            <div class="flex justify-between items-center mt-2">
                <span class="text-sm text-gray-600">{{ $notification->created_at->diffForHumans() }}</span>
                @if (!$notification->read)
                    <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST">
                        @csrf
                        <button type="submit" class="text-blue-500 hover:underline">Tandai sudah dibaca</button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <p class="text-gray-600">Anda tidak memiliki notifikasi.</p>
    @endforelse
    {{ $notifications->links() }}
</div>
@endsection