<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{ __('Detail Post') }}
</h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100 space-y-4">

                <div>
                    <h3 class="font-medium text-gray-500 dark:text-gray-400">Title</h3>
                    <p class="text-lg font-semibold">{{ $post->capital_title }}</p>
                    <!-- disini kita pakai accessor dari model Post untuk capital title -->
                </div>

                <div>
                    <h3 class="font-medium text-gray-500 dark:text-gray-400">Content</h3>
                    <p class="mt-1">{{ $post->content }}</p>
                </div>

                <div>
                    <h3 class="font-medium text-gray-500 dark:text-gray-400">Price</h3>
                    <p class="text-lg font-semibold">Rp {{ number_format($post->price, 0, ',', '.') }}</p>
                </div>

                <div>
                    <h3 class="font-medium text-gray-500 dark:text-gray-400">Discounted Price</h3>
                    <p class="text-lg font-semibold">Rp {{ number_format($post->discounted_price, 0, ',', '.') }}</p>
                </div>

                <div>
                    <h3 class="font-medium text-gray-500 dark:text-gray-400">Label</h3>
                    <p class="mt-1 text-sm inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full">{{ $post->price_label }}</p>
                </div>

                @if($post->image)
                    <div>
                        <h3 class="font-medium text-gray-500 dark:text-gray-400">Image</h3>
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="mt-2 max-w-sm rounded-lg shadow-md">
                    </div>
                @endif

                <div class="mt-6">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-gray-800 dark:text-gray-200 uppercase tracking-widest hover:bg-gray-300 dark:hover:bg-gray-600">
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>