@if ($paginator->hasPages())
    <div class="mt-6 flex items-center justify-between">
        <p class="text-sm text-slate-600 hidden sm:block">
            Showing <span class="font-semibold">{{ $paginator->firstItem() }}</span> to <span class="font-semibold">{{ $paginator->lastItem() }}</span> of <span class="font-semibold">{{ $paginator->total() }}</span> results
        </p>

        <div class="flex gap-2">
            
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-3 py-2 border border-slate-300 rounded-lg text-slate-400 bg-slate-50 text-sm font-medium cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 text-sm font-medium transition">
                    Previous
                </a>
            @endif

            {{-- Pagination Elements (Angka Halaman) --}}
            <div class="hidden sm:flex gap-2">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="px-3 py-2 text-slate-400 text-sm font-medium">{{ $element }}</span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-2 border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 text-sm font-medium transition">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50 text-sm font-medium transition">
                    Next
                </a>
            @else
                <span class="px-3 py-2 border border-slate-300 rounded-lg text-slate-400 bg-slate-50 text-sm font-medium cursor-not-allowed">
                    Next
                </span>
            @endif
        </div>
    </div>
@endif