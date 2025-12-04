<x-app-layout>
    <div class="container py-4">

        <div class="mb-4">
            <h2 class="fw-bold text-dark">Jelajahi Restoran</h2>
            <p class="text-muted">Temukan tempat makan terbaik di sekitar Binus University.</p>
        </div>

        <div class="row">
            <div class="col-lg-3 mb-4">
                <x-restaurant-filter
                    :categories="$categories"
                    :action="route('explore')" />
            </div>

            <div class="col-lg-9">

                <x-active-filters />

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted small">
                        Menampilkan <strong>{{ $restaurants->firstItem() ?? 0 }} - {{ $restaurants->lastItem() ?? 0 }}</strong> dari <strong>{{ $restaurants->total() }}</strong> restoran
                    </span>
                </div>

                <div class="row g-4">
                    @forelse($restaurants as $restaurant)
                    <div class="col-12">
                        @include('components.restaurant-card', ['restaurant' => $restaurant])
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <div class="mb-3">
                            <i class="bi bi-search text-secondary" style="font-size: 3rem; opacity: 0.3;"></i>
                        </div>
                        <h5 class="fw-bold text-muted">Yah, tidak ketemu...</h5>
                        <p class="text-muted small">Coba kurangi filter atau cari dengan kata kunci lain.</p>
                        <a href="{{ route('explore') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                            Reset Pencarian
                        </a>
                    </div>
                    @endforelse
                </div>

                <div class="mt-5 d-flex justify-content-center">
                    {{ $restaurants->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>