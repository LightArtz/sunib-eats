@extends('layouts.admin')

@section('header')
    Create Restaurant
@endsection

@section('content') 

    <div class="min-h-screen bg-slate-50 p-6">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Add New Restaurant</h1>
            <p class="text-slate-500 mt-1">Create a new restaurant partner profile</p>
        </div>

        <div class="max-w-6xl" x-data="restaurantForm()">
            <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Basic Information</h2>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Restaurant Name *</label>
                                <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., Maharaja Palace" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Location *</label>
                                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g., Downtown Mumbai" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                @error('location') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-2">Average Price (IDR) *</label>
                                <input type="number" name="avg_price" value="{{ old('avg_price') }}" placeholder="35000" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                                @error('avg_price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Categories</h2>
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($categories as $category)
                                    <label class="flex items-center">
                                        <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                        <span class="ml-3 text-slate-700">{{ $category->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('categories') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Description</h2>
                            <textarea name="description" rows="6" class="w-full px-4 py-2 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h2 class="text-lg font-semibold text-slate-900 mb-4">Restaurant Image</h2>
                            
                            <div class="mb-4 w-full h-40 bg-slate-100 rounded-lg border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden relative">
                                <img x-show="imagePreview" :src="imagePreview" class="absolute inset-0 w-full h-full object-cover">
                                <div x-show="!imagePreview" class="text-center">
                                    <p class="text-xs text-slate-500">No image selected</p>
                                </div>
                            </div>

                            <input type="file" name="image_url" @change="previewImage" accept="image/*" class="w-full text-sm text-slate-600 file:mr-4 file:px-3 file:py-1 file:bg-indigo-50 file:border-0 file:rounded file:text-indigo-600 file:cursor-pointer">
                            @error('image_url') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
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
                                        {{-- Logic Checked untuk Edit Page --}}
                                        @if(isset($restaurant) && $restaurant->approved) checked @endif
                                        {{-- Logic Checked untuk Create Page (Alpine) --}}
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
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">Create Restaurant</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function restaurantForm() {
            return {
                imagePreview: null,
                approved: true, // Default checked

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