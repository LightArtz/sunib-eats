@extends('layouts.admin')

@section('header')
    Edit Restaurant
@endsection

@section('content')     
    <div class="min-h-screen bg-slate-50 p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Edit Restaurant</h1>
            <p class="text-slate-500 mt-1">Update restaurant partner profile</p>
        </div>

        <div class="max-w-6xl" x-data="restaurantEditForm()">
            <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Basic Information</h2>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Restaurant Name *</label>
                                <input type="text" name="name" value="{{ old('name', $restaurant->name) }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Location *</label>
                                <input type="text" name="location" value="{{ old('location', $restaurant->location) }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Average Price (IDR) *</label>
                                <input type="number" name="avg_price" value="{{ old('avg_price', $restaurant->avg_price) }}" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Categories</h2>
                            <div class="grid grid-cols-2 gap-3">
                                @php
                                    // Ambil array ID kategori yang dimiliki restoran ini
                                    $selectedCategories = $restaurant->categories->pluck('id')->toArray();
                                @endphp
                                @foreach($categories as $category)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                            class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                                            {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}
                                        >
                                        <span class="ml-3 text-slate-700">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Description</h2>
                            <textarea name="description" rows="6" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('description', $restaurant->description) }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Restaurant Image</h2>
                            <div class="mb-4 w-full h-40 bg-slate-100 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden relative">
                                @if($restaurant->image_url)
                                    <img 
                                        src="{{ Str::startsWith($restaurant->image_url, 'http') ? $restaurant->image_url : Storage::url($restaurant->image_url) }}" 
                                        alt="{{ $restaurant->name }}" 
                                        class="w-25 h-25 rounded-lg object-cover"
                                    >
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-slate-200 flex items-center justify-center text-slate-400 text-xs">No Img</div>
                                @endif
                            </div>
                            <input type="file" name="image_url" @change="previewImage" accept="image/*" class="w-full text-sm text-slate-600 file:mr-4 file:px-3 file:py-1 file:bg-indigo-50 file:border-0 file:rounded file:text-indigo-600 file:cursor-pointer">
                        </div>

                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Status</h2>
                            <label class="flex items-center justify-between p-3 border border-slate-200 rounded-lg cursor-pointer hover:bg-slate-50 transition-colors">
                                <span class="text-slate-700">Approve this restaurant?</span>
                                <div class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="approved" value="0">
                                    <input 
                                        type="checkbox" 
                                        name="approved" 
                                        value="1" 
                                        class="sr-only peer"
                                        @if(isset($restaurant) && $restaurant->approved) checked @endif
                                        x-model="approved" 
                                    >
                                    
                                    <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 lg:col-span-2">
                    <a href="{{ route('admin.restaurants.index') }}" class="px-6 py-2 border border-slate-200 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors font-medium">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function restaurantEditForm() {
            return {
                // Initialize Alpine data with existing server data
                imagePreview: '{{ $restaurant->image_url ? Storage::url($restaurant->image_url) : "" }}',
                approved: {{ $restaurant->approved ? 'true' : 'false' }},

                previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = (e) => { this.imagePreview = e.target.result; };
                        reader.readAsDataURL(file);
                    }
                }
            }
        }
    </script>

@endsection