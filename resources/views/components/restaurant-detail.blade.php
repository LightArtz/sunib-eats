<x-app-layout>

    <div class="position-relative rounded overflow-hidden shadow-sm mb-4" style="height: 350px;">
        <img src="{{ $restaurant->image_url }}"
            alt="{{ $restaurant->name }}"
            class="w-100 h-100"
            style="object-fit: cover; filter: brightness(0.4);">

        <div class="position-absolute top-50 start-50 translate-middle text-center w-100 px-3">
            <h1 class="display-4 fw-bold text-white">{{ $restaurant->name }}</h1>

            <div class="d-flex justify-content-center align-items-center gap-3 text-white mt-2">
                <span class="fs-5"><i class="bi bi-geo-alt-fill"></i> {{ $restaurant->location }}</span>
                <span>|</span>
                <span class="fs-5 fw-bold text-warning">
                    {{ $restaurant->avg_rating }} ★
                </span>
                <span>|</span>
                <span class="fs-5 text-success fw-bold">
                    @if($restaurant->avg_price < 50000) $
                    @elseif($restaurant->avg_price < 100000) $$
                    @else $$$
                    @endif
                </span>
            </div>

            <p class="text-white-50 mt-3 d-none d-md-block mx-auto" style="max-width: 700px;">
                {{ $restaurant->description }}
            </p>
        </div>

        <a href="{{ route('home') }}" class="btn btn-light btn-sm position-absolute top-0 start-0 m-3 rounded-circle shadow" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
            ←
        </a>
    </div>

    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card shadow-sm mb-4 border-0">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0">🎟️ Promo Aktif</h4>
                </div>
                <div class="card-body p-4">
                    @if($restaurant->promotions->count() > 0)
                    <div class="row g-3">
                        @foreach($restaurant->promotions as $promo)
                        <div class="col-md-6">
                            <div class="card h-100 border-warning border-2">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge bg-danger me-2">PROMO</span>
                                        <small class="text-muted">Berakhir: {{ $promo->end_date->format('d M Y') }}</small>
                                    </div>
                                    <h5 class="card-title fw-bold">{{ $promo->title }}</h5>
                                    <p class="card-text small text-secondary">{{ $promo->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="alert alert-secondary text-center mb-0">
                        Tidak ada promo yang sedang berlangsung saat ini.
                    </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold mb-0">💬 Ulasan Pengunjung</h4>
                    <span class="badge bg-primary rounded-pill">{{ $restaurant->reviews->count() }} Komentar</span>
                </div>

                <div class="card-body p-4">
                    @forelse($restaurant->reviews as $review)
                    <div class="d-flex mb-4 border-bottom pb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                        </div>

                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold mb-0">{{ $review->user->name }}</h6>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>

                            <div class="text-warning small mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                @endfor
                            </div>

                            <p class="mb-0 text-dark">{{ $review->content }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4 text-muted">
                        <p>Belum ada ulasan. Jadilah yang pertama mereview restoran ini!</p>
                    </div>
                    @endforelse
                </div>
            </div>
            
        </div> <div class="col-lg-4">

            <div class="card shadow-sm border-0 sticky-top" style="top: 20px; z-index: 1;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Tulis Ulasan</h5>

                    @auth
                    <form action="{{ route('reviews.store', $restaurant->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small text-muted">Rating Anda</label>
                            <select name="rating" class="form-select">
                                <option value="5">⭐⭐⭐⭐⭐ (5 - Sempurna)</option>
                                <option value="4">⭐⭐⭐⭐ (4 - Bagus)</option>
                                <option value="3">⭐⭐⭐ (3 - Biasa)</option>
                                <option value="2">⭐⭐ (2 - Kurang)</option>
                                <option value="1">⭐ (1 - Buruk)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Pengalaman Anda</label>
                            <textarea name="content" rows="3" class="form-control" placeholder="Makanannya enak, tempatnya nyaman..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Kirim Ulasan</button>
                    </form>
                    @else
                    <div class="text-center py-3">
                        <p class="small text-muted mb-3">Silakan login untuk menulis ulasan.</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm w-100">Masuk / Daftar</a>
                    </div>
                    @endauth
                </div>
            </div>

            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <h6 class="fw-bold">Jam Operasional</h6>
                    <p class="small text-muted mb-0">Setiap Hari: 10:00 - 22:00 WIB</p>
                    <hr>
                    <h6 class="fw-bold">Kisaran Harga</h6>
                    <p class="small text-muted mb-0">Rp {{ number_format($restaurant->avg_price, 0, ',', '.') }} / orang</p>
                </div>
            </div>

        </div> </div> </x-app-layout>