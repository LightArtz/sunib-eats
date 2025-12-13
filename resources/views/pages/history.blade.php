<x-app-layout>
    <div class="container py-4">

        <div class="mb-4">
            <h2 class="fw-bold text-dark">Riwayat Ulasan 🕒</h2>
            <p class="text-muted">Kelola semua ulasan yang pernah Anda berikan.</p>
        </div>

        <div class="row">
            <div class="col-lg-8">

                @forelse($reviews as $review)
                <div class="card border-0 shadow-sm mb-4 rounded-4 overflow-hidden">

                    <div class="card-header bg-white border-0 pt-3 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shop text-primary"></i>
                            <a href="{{ route('restaurants.show', $review->restaurant->slug) }}" class="fw-bold text-decoration-none text-dark hover-primary">
                                {{ $review->restaurant->name }}
                            </a>
                        </div>
                        <small class="text-muted">{{ $review->created_at->format('d M Y') }}</small>
                    </div>

                    <div class="card-body px-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="text-warning small">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                    @endfor
                                    <span class="text-dark fw-bold ms-1">({{ $review->rating }})</span>
                            </div>
                            @if($review->price_per_portion)
                            <span class="badge bg-light text-dark border">
                                Rp {{ number_format($review->price_per_portion, 0, ',', '.') }} / pax
                            </span>
                            @endif
                        </div>

                        <p class="text-dark mb-3">{{ $review->content }}</p>

                        @if($review->images->count() > 0)
                        <div class="d-flex gap-2 mb-3 overflow-auto">
                            @foreach($review->images as $img)
                            <img src="{{ Str::startsWith($img->path, 'http') 
                                            ? $img->path 
                                            : Storage::url($img->path) }}"
                                class="rounded border"
                                style="width: 70px; height: 70px; object-fit: cover;">
                            @endforeach
                        </div>
                        @endif

                        <hr class="text-muted opacity-25">

                        <div class="d-flex justify-content-end gap-2">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-bold">
                                <i class="bi bi-pencil-square me-1"></i> Edit
                            </a>

                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" style="width: 100px; opacity: 0.5;">
                    <p class="text-muted mt-3">Kamu belum pernah menulis ulasan.</p>
                    <a href="{{ route('explore') }}" class="btn btn-primary rounded-pill px-4">Mulai Menjelajah</a>
                </div>
                @endforelse

                <div class="mt-4">
                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>