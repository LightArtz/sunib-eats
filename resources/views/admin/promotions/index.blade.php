@extends('layouts.admin')

@section('header')
    Promotions
@endsection

@section('content')

    <div class="p-8" x-data="promotionTable()">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Promotions</h1>
                <p class="text-slate-600 mt-2">Manage discounts and promotional campaigns</p>
            </div>
            <a href="{{ route('admin.promotions.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                Add Promotion
            </a>
        </div>

        <div class="mb-6">
            <form action="{{ route('admin.promotions.index') }}" method="GET">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search promotions..." 
                    class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                />
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Image</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Title</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Restaurant</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Duration</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Status</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-900">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($promotions as $promotion)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    @if($promotion->image)
                                        <img 
                                             
                                            alt="Promotion" src="{{ Str::startsWith($promotion->image, 'http') ? $promotion->image : Storage::disk('cloudinary')->url($promotion->image) }}"
                                            class="w-12 h-12 rounded-lg object-cover" 
                                        />
                                    @else
                                        <div class="w-12 h-12 bg-slate-200 rounded-lg flex items-center justify-center text-xs text-slate-500">No Img</div>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4 text-slate-900 font-medium">{{ $promotion->title }}</td>
                                
                                <td class="px-6 py-4">
                                    <span class="bg-indigo-100 text-indigo-800 text-xs font-semibold px-3 py-1 rounded-full">
                                        {{ $promotion->restaurant->name }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4 text-slate-600 text-sm">
                                    {{ \Carbon\Carbon::parse($promotion->start_date)->format('M d') }} - 
                                    {{ \Carbon\Carbon::parse($promotion->end_date)->format('M d') }}
                                </td>
                                
                                <td class="px-6 py-4">
                                    @php
                                        $isActive = now()->between($promotion->start_date, $promotion->end_date);
                                    @endphp
                                    <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $isActive ? 'Active' : 'Expired' }}
                                    </span>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <div class="flex gap-3">
                                        <a href="{{ route('admin.promotions.edit', $promotion) }}" class="text-indigo-600 hover:text-indigo-800 p-2 hover:bg-indigo-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-7-4l7-7m0 0H9m7 0v7" /></svg>
                                        </a>
                                        <button @click="deleteConfirm('{{ route('admin.promotions.destroy', $promotion) }}')" class="text-red-600 hover:text-red-800 p-2 hover:bg-red-50 rounded-lg transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-slate-500">No promotions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
            {{ $promotions->withQueryString()->links('pagination.admin') }}
        </div>

        <div x-show="showDeleteModal" @click.self="showDeleteModal = false" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;" x-transition>
            <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full mx-4">
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Delete Promotion?</h3>
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
        function promotionTable() {
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