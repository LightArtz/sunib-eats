@extends('layouts.admin')

@section('header')
    Restaurants
@endsection

@section('content')

    <div class="min-h-screen bg-slate-50 p-6" x-data="restaurantTable()">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Restaurants</h1>
                <p class="text-slate-500 mt-1">Manage all restaurant partners</p>
            </div>
            <a href="{{ route('admin.restaurants.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                <span class="mr-2">+</span> Add New Restaurant
            </a>
        </div>

        <div class="mb-6">
            <form action="{{ route('admin.restaurants.index') }}" method="GET">
                <input 
                    type="text" 
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by restaurant name or location..."
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                >
            </form>
        </div>

        <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-slate-200">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wide">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wide">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wide">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wide">Avg Price</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wide">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-700 uppercase tracking-wide">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($restaurants as $restaurant)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                @if($restaurant->image_url)
                                    <img 
                                        src="{{ Str::startsWith($restaurant->image_url, 'http') ? $restaurant->image_url : Storage::disk('cloudinary')->url($restaurant->image_url) }}"
                                        alt="{{ $restaurant->name }}" 
                                        class="w-12 h-12 rounded-lg object-cover"
                                    >
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-slate-200 flex items-center justify-center text-slate-400 text-xs">No Img</div>
                                @endif
                            </td>
                            
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $restaurant->name }}</td>
                            
                            <td class="px-6 py-4 text-slate-600">{{ $restaurant->location }}</td>
                            
                            <td class="px-6 py-4 text-slate-600">IDR {{ number_format($restaurant->avg_price) }}</td>
                            
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $restaurant->approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $restaurant->approved ? 'Approved' : 'Pending' }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="inline-flex items-center justify-center w-8 h-8 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <button 
                                        @click="deleteConfirm('{{ route('admin.restaurants.destroy', $restaurant) }}', '{{ $restaurant->name }}')"
                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <p class="text-slate-500">No restaurants found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $restaurants->withQueryString()->links('pagination.admin') }}
        </div>

        <div x-show="showDeleteModal" class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" style="display: none;" x-transition>
            <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Delete Restaurant</h3>
                <p class="text-slate-600 mb-6">Are you sure you want to delete "<span x-text="deleteItemName" class="font-medium"></span>"? This action cannot be undone.</p>
                <div class="flex gap-3">
                    <button @click="showDeleteModal = false" class="flex-1 px-4 py-2 border border-slate-200 rounded-lg text-slate-700 hover:bg-slate-50 transition-colors font-medium">
                        Cancel
                    </button>
                    <form :action="deleteUrl" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function restaurantTable() {
            return {
                showDeleteModal: false,
                deleteUrl: '',
                deleteItemName: '',

                deleteConfirm(url, name) {
                    this.deleteUrl = url;
                    this.deleteItemName = name;
                    this.showDeleteModal = true;
                }
            }
        }
    </script>

@endsection