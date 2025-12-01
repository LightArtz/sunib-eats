<x-app-layout>

    @if(isset($promotions) && $promotions->count() > 0)
    <div id="promoCarousel" class="carousel slide mb-5 rounded shadow overflow-hidden" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-indicators">
            @foreach ($promotions as $index => $promo)
            <button type="button" data-bs-target="#promoCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="true"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($promotions as $index => $promo)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="position-relative" style="width: 100%; aspect-ratio: 16/9; max-height: 450px;">
                    <img src="{{ $promo->image }}" class="d-block w-100 h-100" style="object-fit: cover; filter: brightness(0.5);" alt="{{ $promo->title }}">
                    <div class="carousel-caption d-none d-md-block text-start" style="bottom: 10%; left: 5%; right: 5%;">
                        <span class="badge bg-danger mb-2">PROMO SPESIAL</span>
                        <h2 class="fw-bold text-white">{{ $promo->title }}</h2>
                        <p class="mb-3 d-none d-lg-block">{{ $promo->description }}</p>
                        <a href="{{ route('restaurants.show', $promo->restaurant->slug ?? $promo->restaurant->id) }}" class="btn btn-warning fw-bold mt-1 px-4">Lihat Promo</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
    @endif


    <div class="row">

        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm border-0 sticky-top" style="top: 20px; z-index: 1;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4"><i class="bi bi-funnel-fill text-primary"></i> Filter</h5>

                    <form action="{{ route('home') }}" method="GET">
                        @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        @if(isset($categories))
                        @foreach($categories as $type => $catList)
                        <div class="mb-4">
                            <h6 class="fw-bold text-uppercase text-muted small mb-3">
                                {{ str_replace('_', ' ', $type) }}
                            </h6>
                            <div class="row g-2">
                                @foreach($catList as $cat)
                                <div class="col-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            name="categories[]"
                                            value="{{ $cat->id }}"
                                            id="cat-{{ $cat->id }}"
                                            {{ in_array($cat->id, request('categories', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label text-dark small text-truncate d-block" for="cat-{{ $cat->id }}" title="{{ ucwords($cat->name) }}">
                                            {{ ucwords($cat->name) }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <hr class="text-muted opacity-25">
                        @endforeach
                        @endif

                        <div class="mb-4">
                            <h6 class="fw-bold text-uppercase text-muted small mb-3">Urutkan</h6>
                            <div class="d-flex flex-column gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" id="sortNew" value="newest" {{ request('sort') == 'newest' ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="sortNew">Paling Baru</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" id="sortRating" value="rating_desc" {{ request('sort') == 'rating_desc' ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="sortRating">Rating Tertinggi</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sort" id="sortCheap" value="price_asc" {{ request('sort') == 'price_asc' ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="sortCheap">Harga Terendah</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-sm fw-bold">Terapkan</button>
                            @if(request()->hasAny(['search', 'sort', 'categories']))
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9">

            @if(!request('search') && !request('categories'))
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold m-0 text-danger">🔥 Hot Recommendations</h3>
                    <small class="text-muted">Paling hits minggu ini!</small>
                </div>
            </div>

            <div class="row g-4 mb-5">
                @foreach($hotRestaurants as $hotResto) <div class="col-12">
                    @include('components.restaurant-card', ['restaurant' => $hotResto])
                </div>
                @endforeach
            </div>

            <hr class="my-5"> @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    @if(request('search') || request('categories'))
                    <h3 class="fw-bold m-0">Hasil Pencarian</h3>
                    @if(request('search'))
                    <small class="text-muted">Kata kunci: "<strong>{{ request('search') }}</strong>"</small>
                    @endif
                    @else
                    <h3 class="fw-bold m-0">✨ Daily Recommendations</h3>
                    <small class="text-muted">Pilihan menarik lainnya untuk kamu</small>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                @foreach($restaurants as $restaurant)
                <div class="col-12">
                    @include('components.restaurant-card', ['restaurant' => $restaurant])
                </div>
                @endforeach
            </div>

            <div class="mt-5 d-flex justify-content-center">
                {{ $restaurants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>