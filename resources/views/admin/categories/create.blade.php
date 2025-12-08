@extends('layouts.admin')

@section('header')
    Add Category
@endsection

@section('content')
<div class="max-w-2xl mx-auto p-6">
    
    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="flex items-center text-slate-500 hover:text-indigo-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Categories
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6">
        <h2 class="text-xl font-bold text-slate-900 mb-6">Create New Category</h2>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Category Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}"
                    placeholder="e.g. Japanese, Fast Food, Dessert"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-slate-900 @error('name') @enderror"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-8">
                <label for="type" class="block text-sm font-medium text-slate-700 mb-2">Category Type</label>
                <input 
                    type="text" 
                    name="type" 
                    id="type" 
                    value="{{ old('type') }}"
                    placeholder="e.g. Cuisine, Dietary, Dish, Promotion"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-slate-900 @error('type') @enderror"
                    required
                >
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 border border-slate-300 rounded-lg text-slate-700 font-medium hover:bg-slate-50 transition text-center">
                    Cancel
                </a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition shadow-sm">
                    Save Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection