<x-app-layout>

    <div class="position-relative rounded overflow-hidden shadow-sm mb-4" style="height: 350px;">
        <img src="{{ Str::startsWith($restaurant->image_url, 'http') ? $restaurant->image_url : Storage::disk('cloudinary')->url($restaurant->image_url) }}"
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
                    {{ $restaurant->price_symbol }}
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

            <x-restaurant-reviews :restaurant="$restaurant" />

        </div>

        <div class="col-lg-4">
            <x-review-form :restaurant="$restaurant" />
            <div class="card shadow-sm border-0 mt-4">
                <div class="card-body">
                    <h6 class="fw-bold">Info Tambahan</h6>
                    <div class="d-flex justify-content-between align-items-center mb-2 mt-3">
                        <span class="small text-muted">Jam Buka</span>
                        <span class="small fw-bold">10:00 - 22:00</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="small text-muted">Avg. Harga</span>
                        <span class="small fw-bold">Rp {{ number_format($restaurant->avg_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>