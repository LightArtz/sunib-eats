@extends('layouts.admin')

@section('header')
    Edit Review
@endsection

@section('content')

    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Edit Review</h1>
            <p class="text-slate-600 mt-2">Moderate and update review content</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-8 max-w-2xl">
            <form action="{{ route('admin.reviews.update', $review) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="bg-slate-50 p-6 rounded-lg border border-slate-200">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-slate-600 mb-1">User</p>
                            <p class="font-semibold text-slate-900">{{ $review->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600 mb-1">Restaurant</p>
                            <p class="font-semibold text-slate-900">{{ $review->restaurant->name }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-3">Rating (1-5 stars) *</label>
                    <div x-data="{ rating: {{ $review->rating }} }" class="flex gap-2">
                        <input type="hidden" name="rating" :value="rating">
                        
                        <template x-for="i in 5">
                            <button type="button" @click="rating = i" :class="{ 'text-yellow-400': i <= rating, 'text-slate-300': i > rating }" class="text-3xl transition hover:scale-110">
                                ★
                            </button>
                        </template>
                        <span class="ml-4 text-lg font-semibold text-slate-900" x-text="`${rating} / 5`"></span>
                    </div>
                    @error('rating') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-900 mb-2">Review Comment *</label>
                    <textarea name="content" rows="6" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none">{{ old('content', $review->content) }}</textarea>
                    <p class="text-sm text-slate-500 mt-2">Note: Edit comment for moderation purposes only.</p>
                    @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex gap-4 pt-6 border-t border-slate-200">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">Save Changes</button>
                    <a href="{{ route('admin.reviews.index') }}" class="border border-slate-300 text-slate-700 hover:bg-slate-50 px-6 py-3 rounded-lg font-medium transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection