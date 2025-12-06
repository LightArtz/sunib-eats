@props(['restaurant'])

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

            <div class="d-flex align-items-center gap-2">
                <h4 class="fw-bold mb-0">💬 Ulasan Pengunjung</h4>
                <span class="badge bg-primary rounded-pill">{{ $restaurant->reviews->count() }}</span>
            </div>
            <x-reviews-filter />
        </div>
    </div>

    <div class="card-body p-4">
        @forelse($restaurant->reviews as $review)
        <x-review-card :review="$review" />
        @empty
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/1660/1660114.png" style="width: 80px; opacity: 0.5;" alt="No Reviews">
            <p class="text-muted mt-3">Belum ada ulasan. Jadilah yang pertama!</p>
        </div>
        @endforelse
    </div>
</div>