@props(['restaurant'])

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
        <h4 class="fw-bold mb-0">💬 Ulasan Pengunjung</h4>
        <span class="badge bg-primary rounded-pill">{{ $restaurant->reviews->count() }} Komentar</span>
    </div>

    <div class="card-body p-4">
        @forelse($restaurant->reviews as $review)
        <div class="d-flex mb-4 border-bottom pb-3">

            <div class="flex-shrink-0 text-center" style="width: 60px;">
                @if($review->user->profile_picture)
                <img src="{{ asset('storage/'.$review->user->profile_picture) }}" class="rounded-circle shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                @else
                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto shadow-sm" style="width: 50px; height: 50px; font-size: 1.2rem;">
                    {{ substr($review->user->name, 0, 1) }}
                </div>
                @endif

                <div class="d-flex flex-column align-items-center mt-2 gap-1 vote-container" data-review-id="{{ $review->id }}">
                    <button class="btn btn-sm p-0 border-0 btn-vote upvote {{ $review->current_user_vote == 1 ? 'text-warning' : 'text-muted' }}"
                        onclick="vote('{{ $review->id }}', 1)"
                        {{ $review->user_id == Auth::id() ? 'disabled title="Tidak bisa vote sendiri"' : '' }}>
                        <i class="bi bi-caret-up-fill fs-4"></i>
                    </button>

                    <span class="fw-bold small vote-score">{{ $review->score }}</span>

                    <button class="btn btn-sm p-0 border-0 btn-vote downvote {{ $review->current_user_vote == -1 ? 'text-danger' : 'text-muted' }}"
                        onclick="vote('{{ $review->id }}', -1)"
                        {{ $review->user_id == Auth::id() ? 'disabled' : '' }}>
                        <i class="bi bi-caret-down-fill fs-4"></i>
                    </button>
                </div>
            </div>

            <div class="flex-grow-1 ms-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                        <small class="text-muted" style="font-size: 0.8rem;">{{ $review->created_at->diffForHumans() }}</small>
                    </div>

                    @if($review->price_per_portion)
                    <span class="badge bg-light text-dark border">
                        Rp {{ number_format($review->price_per_portion, 0, ',', '.') }}
                    </span>
                    @endif
                </div>

                <div class="text-warning small mb-2 mt-1">
                    @for($i = 1; $i <= 5; $i++)
                        {{ $i <= $review->rating ? '★' : '☆' }}
                    @endfor
                </div>

                <p class="mb-2 text-dark">{{ $review->content }}</p>

                @if($review->images->count() > 0)
                <div class="d-flex gap-2 mt-2 overflow-auto pb-2">
                    @foreach($review->images as $img)
                    <a href="{{ asset('storage/' . $img->path) }}" target="_blank">
                        <img src="{{ asset('storage/' . $img->path) }}"
                            class="rounded border shadow-sm"
                            style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                            alt="Review Image">
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/1660/1660114.png" style="width: 80px; opacity: 0.5;" alt="No Reviews">
            <p class="text-muted mt-3">Belum ada ulasan. Jadilah yang pertama!</p>
        </div>
        @endforelse
    </div>
</div>