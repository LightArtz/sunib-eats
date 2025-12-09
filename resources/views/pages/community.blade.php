<x-app-layout>
    <div class="container py-4">

        <div class="text-center mb-5">
            <h2 class="fw-bold text-dark">Komunitas Kuliner 💬</h2>
            <p class="text-muted">Lihat apa kata mereka tentang makanan di sekitar Binus!</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                @forelse($reviews as $review)
                <div class="card border-0 shadow-sm mb-4 rounded-4 overflow-hidden">

                    <div class="card-header bg-white border-0 pt-3 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <span class="small text-muted">
                            <a href="{{ route('restaurants.show', $review->restaurant->slug) }}" class="fw-bold text-decoration-none text-dark hover-primary">
                                {{ $review->restaurant->name }}
                            </a>
                        </span>

                        <div class="text-warning small">
                            <span class="fw-bold text-dark me-1">{{ $review->rating }}</span>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>

                    <div class="card-body px-4 pb-2">
                        <x-review-card :review="$review" />
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" style="width: 100px; opacity: 0.5;">
                    <p class="text-muted mt-3">Belum ada aktivitas komunitas. Jadilah yang pertama!</p>
                    <a href="{{ route('explore') }}" class="btn btn-primary rounded-pill px-4">Mulai Review</a>
                </div>
                @endforelse

                <div class="mt-5 d-flex justify-content-center">
                    {{ $reviews->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>