@extends('layouts.admin')

@section('header')
    Edit Promotion
@endsection

@section('content')

    <div class="p-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Edit Promotion</h1>
            <p class="text-slate-600 mt-2">Update promotional campaign</p>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-8">
            <form action="{{ route('admin.promotions.update', $promotion) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Restaurant *</label>
                        <select name="restaurant_id" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            @foreach($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}" {{ old('restaurant_id', $promotion->restaurant_id) == $restaurant->id ? 'selected' : '' }}>
                                    {{ $restaurant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Title *</label>
                        <input type="text" name="title" value="{{ old('title', $promotion->title) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-900 mb-2">Description</label>
                        <textarea name="description" rows="4" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('description', $promotion->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">Start Date *</label>
                            <input type="date" name="start_date" value="{{ old('start_date', $promotion->start_date) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-900 mb-2">End Date *</label>
                            <input type="date" name="end_date" value="{{ old('end_date', $promotion->end_date) }}" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required />
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div 
                        x-data="{ imagePreview: '{{ $promotion->image ? (Str::startsWith($promotion->image, 'http') ? $promotion->image : Storage::url($promotion->image)) : "" }}' }" 
                        class="bg-slate-50 p-6 rounded-lg border-2 border-dashed border-slate-300 hover:border-indigo-500 transition cursor-pointer relative"
                        @click="$refs.fileInput.click()"
                    >
                        
                        <input type="file" name="image" x-ref="fileInput" class="hidden" @change="const file = $event.target.files[0]; const reader = new FileReader(); reader.onload = (e) => { imagePreview = e.target.result; }; reader.readAsDataURL(file);" accept="image/*" />
                        
                        <div x-show="!imagePreview" class="text-center py-12">
                            <p class="text-slate-600 font-medium">Click to change banner</p>
                        </div>
                        
                        <img x-show="imagePreview" :src="imagePreview" class="w-full h-48 object-cover rounded-lg" />
                    </div>
                </div>

                <div class="col-span-1 lg:col-span-2 flex gap-4 pt-8 border-t border-slate-200">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition">Save Changes</button>
                    <a href="{{ route('admin.promotions.index') }}" class="border border-slate-300 text-slate-700 hover:bg-slate-50 px-6 py-3 rounded-lg font-medium transition">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection