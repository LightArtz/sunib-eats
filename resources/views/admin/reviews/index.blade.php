@extends('layouts.admin')

@section('header')
    Reviews
@endsection

@section('content')

    <div class="p-8" x-data="reviewTable()">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Reviews</h1>
                <p class="text-slate-600 mt-2">Manage and moderate customer reviews</p>
            </div>
        </div>

        <div class="mb-6">
            <form action="{{ route('admin.reviews.index') }}" method="GET">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search reviews by user or restaurant..." 
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                />
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">User</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Restaurant</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Rating</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Date</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Comment</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($reviews as $review)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($review->user->profile_picture)
                                            <img src="{{ Storage::url($review->user->profile_picture) }}" class="w-10 h-10 rounded-full object-cover" />
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name) }}&background=random" class="w-10 h-10 rounded-full" />
                                        @endif
                                        <div>
                                            <p class="text-slate-900 font-medium">{{ $review->user->name }}</p>
                                            <p class="text-slate-500 text-sm">{{ $review->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 text-slate-900 font-medium">{{ $review->restaurant->name }}</td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-1">
                                        <span class="text-yellow-400">★</span>
                                        <span class="text-slate-600 text-sm font-bold">{{ $review->rating }}.0</span>
                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 text-slate-600 text-sm">{{ $review->created_at->format('M d, Y') }}</td>
                                
                                <td class="px-6 py-4">
                                    <p class="text-slate-600 text-sm truncate max-w-xs" title="{{ $review->content }}">
                                        {{ Str::limit($review->content, 50) }}
                                    </p>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex gap-3">
                                        <a href="{{ route('admin.reviews.show', $review) }}" class="text-blue-600 hover:text-blue-800 p-2 hover:bg-blue-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>
                                        <a href="{{ route('admin.reviews.edit', $review) }}" class="text-indigo-600 hover:text-indigo-800 p-2 hover:bg-indigo-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <button @click="deleteConfirm('{{ route('admin.reviews.destroy', $review) }}')" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">No reviews found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $reviews->withQueryString()->links('pagination.admin') }}
        </div>

        <div x-show="showDeleteModal" @click.self="showDeleteModal = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;" x-transition>
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full mx-4">
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Delete Review?</h3>
                <p class="text-slate-600 text-sm mb-6">Are you sure? This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button @click="showDeleteModal = false" class="flex-1 px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50">Cancel</button>
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function reviewTable() {
            return {
                showDeleteModal: false,
                deleteUrl: '',
                deleteConfirm(url) {
                    this.deleteUrl = url;
                    this.showDeleteModal = true;
                }
            }
        }
    </script>
@endsection