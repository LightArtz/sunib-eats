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
                        @if($promo->restaurant)
                        <a href="{{ route('restaurants.show', $promo->restaurant) }}"
                            class="btn btn-warning fw-bold mt-1 px-4 position-relative"
                            style="z-index: 10;">
                            Lihat Promo
                        </a>
                        @else
                        <button class="btn btn-secondary fw-bold mt-1 px-4 position-relative"
                            style="z-index: 10;" disabled>
                            Promo Berakhir
                        </button>
                        @endif
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
            <x-restaurant-filter :categories="$categories" />
        </div>

        <div class="col-lg-9">
            @if(!request()->hasAny(['search', 'categories', 'price', 'sort']))
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold m-0 text-danger">🔥 Hot Recommendations</h3>
                    <small class="text-muted">Paling hits minggu ini!</small>
                </div>
            </div>

            <div class="row g-4 mb-5">
                @foreach($hotRestaurants as $hotResto)
                <div class="col-12">
                    @include('components.restaurant-card', ['restaurant' => $hotResto])
                </div>
                @endforeach
            </div>

            <hr class="my-5">
            @endif

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    @if(request()->hasAny(['search', 'categories', 'price', 'sort']))
                    <h3 class="fw-bold m-0">Hasil Pencarian</h3>

                    <div class="mt-1 small text-muted">
                        Menampilkan hasil untuk:
                        @if(request('search'))
                        <span class="badge bg-light text-dark border">"{{ request('search') }}"</span>
                        @endif
                        @if(request('price'))
                        @php
                        $priceLabels = [
                        '1' => 'Cheap ($)',
                        '2' => 'Affordable ($$)',
                        '3' => 'Pricy ($$$)',
                        '4' => 'Premium ($$$$)',
                        '5' => 'Luxury ($$$$$)'
                        ];
                        @endphp
                        <span class="badge bg-light text-dark border">
                            {{ $priceLabels[request('price')] }}
                        </span>
                        @endif
                        @if(request('categories'))
                        <span class="badge bg-light text-dark border">{{ count(request('categories')) }} Kategori</span>
                        @endif
                    </div>
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

            @if($restaurants->count() == 0)
            <div class="text-center py-5">
                <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" alt="Empty" style="width: 100px; opacity: 0.5;">
                <p class="text-muted mt-3">Tidak ada restoran yang cocok dengan filter kamu.</p>
                <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">Reset Filter</a>
            </div>
            @endif

            <div class="mt-5 d-flex justify-content-center">
                {{ $restaurants->links() }}
            </div>
        </div>
    </div>
</x-app-layout>