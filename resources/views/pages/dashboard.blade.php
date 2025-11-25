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

                    <img src="{{ $promo->image }}"
                        class="d-block w-100 h-100"
                        style="object-fit: cover; filter: brightness(0.5);"
                        alt="{{ $promo->title }}">

                    <div class="carousel-caption d-none d-md-block text-start" style="bottom: 15%; left: 10%; right: 10%;">
                        <span class="badge bg-danger mb-2">PROMO TERBATAS</span>

                        <h1 class="display-4 fw-bold text-white mb-2">{{ $promo->title }}</h1>

                        <p class="fs-5 text-white mb-3">
                            {{ $promo->description }}
                        </p>

                        <div class="mb-4 text-white-50">
                            <small>
                                Berlaku di: <strong>{{ $promo->restaurant->name }}</strong> <br>
                                Hingga: {{ $promo->end_date->format('d M Y') }}
                            </small>
                        </div>

                        <a href="{{ route('restaurants.show', $promo->restaurant->slug ?? $promo->restaurant->id) }}" class="btn btn-warning fw-bold px-4 py-2">
                            Lihat Restoran
                        </a>
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

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0">🔥 Hot Recommendations</h3>
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

</x-app-layout>