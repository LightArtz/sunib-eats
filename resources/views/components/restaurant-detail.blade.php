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

            <div class="card shadow-sm border-0 sticky-top" style="top: 20px; z-index: 1;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Tulis Ulasan</h5>

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 small ps-3">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @auth
                    <form action="{{ route('reviews.store', $restaurant) }}" method="POST" enctype="multipart/form-data">
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
                            <label class="form-label small text-muted">Estimasi Harga per Orang</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">Rp</span>
                                <input type="number"
                                    name="price_per_portion"
                                    class="form-control"
                                    value="{{ old('price_per_portion') }}"
                                    placeholder="Contoh: 25000"
                                    min="1000"
                                    required>
                            </div>
                            @error('price_per_portion')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Pengalaman Anda</label>
                            <textarea name="content" rows="3" class="form-control" placeholder="Ceritakan pengalaman makannya..." required>{{ old('content') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Foto Makanan (Maks 3)</label>

                            <div class="d-flex gap-2 flex-wrap" id="image-upload-container">
                                <div class="upload-box" id="add-image-btn">
                                    <i class="bi bi-plus-lg text-secondary fs-4"></i>
                                </div>
                            </div>

                            <input type="file"
                                id="final-upload-input"
                                name="images[]"
                                class="d-none"
                                multiple>

                            <input type="file"
                                id="file-selector"
                                accept="image/*"
                                multiple
                                class="d-none">

                            <div class="form-text small text-muted mt-2">Format: JPG, PNG. Maks 2MB/foto.</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold">Kirim Ulasan</button>
                    </form>
                    @else
                    <div class="text-center py-4 bg-light rounded">
                        <p class="small text-muted mb-3">Login untuk mulai mereview!</p>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm px-4 fw-bold">Masuk / Daftar</a>
                    </div>
                    @endauth
                </div>
            </div>

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