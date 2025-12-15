@extends('layouts.admin')

@section('header')
    Show Review
@endsection

@section('content')

    <div class="p-8">
        <div class="mb-6">
            <a href="{{ route('admin.reviews.index') }}" class="flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Back to Reviews
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-8">
                <h2 class="text-lg font-bold text-slate-900 mb-6">User Information</h2>
                <div class="flex flex-col items-center text-center">
                    @if($review->user->profile_picture)
                        <img src="{{ Str::startsWith($review->user->profile_picture, 'http') ? $review->user->profile_picture : Storage::url($review->user->profile_picture) }}" class="w-20 h-20 rounded-full object-cover mb-4" />
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=random" class="w-20 h-20 rounded-full mb-4" />
                    @endif
                    <h3 class="text-xl font-bold text-slate-900">{{ $review->user->name }}</h3>
                    <p class="text-slate-600 text-sm">{{ $review->user->email }}</p>
                    <div class="mt-6 space-y-2 w-full text-left">
                        <p class="text-sm text-slate-600"><span class="font-semibold text-slate-900">Phone:</span> {{ $review->user->phone_number ?? '-' }}</p>
                        <p class="text-sm text-slate-600"><span class="font-semibold text-slate-900">Joined:</span> {{ $review->user->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-8">
                    <h2 class="text-lg font-bold text-slate-900 mb-4">Restaurant</h2>
                    <div class="flex items-center gap-4">
                        @if($review->restaurant->image_url)
                            <img src="{{ Str::startsWith($review->restaurant->image_url, 'http') ? $review->restaurant->image_url : Storage::url($review->restaurant->image_url) }}" class="w-16 h-16 rounded-lg object-cover" />
                        @else
                            <div class="w-16 h-16 bg-slate-200 rounded-lg flex items-center justify-center text-xs">No Img</div>
                        @endif
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">{{ $review->restaurant->name }}</h3>
                            <p class="text-slate-600">{{ $review->restaurant->location }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-8">
                    <div class="flex items-center justify-between mb-6 pb-6 border-b border-slate-200">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 mb-2">Review Rating</h2>
                            <div class="flex items-center gap-2">
                                <span class="text-4xl font-bold text-indigo-600">{{ $review->rating }}.0</span>
                                <span class="text-3xl text-yellow-400">
                                    @for($i=0; $i<$review->rating; $i++) ★ @endfor
                                </span>
                            </div>
                        </div>
                        <p class="text-slate-600">Reviewed on {{ $review->created_at->format('M d, Y') }}</p>
                    </div>

                    <h3 class="font-bold text-slate-900 mb-3">Spending Information</h3>
                    <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b border-slate-200">
                        <div class="bg-slate-50 p-4 rounded-lg">
                            <p class="text-sm text-slate-600 mb-1">Price per Portion</p>
                            <p class="text-2xl font-bold text-slate-900">IDR {{ number_format($review->price_per_portion ?? 0) }}</p>
                        </div>
                    </div>

                    <h3 class="font-bold text-slate-900 mb-3">Full Comment</h3>
                    <p class="text-slate-700 leading-relaxed bg-slate-50 p-4 rounded-lg">
                        {{ $review->content }}
                    </p>
                </div>

                <div class="flex gap-4">
                    <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Delete this review?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-medium transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Delete Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection