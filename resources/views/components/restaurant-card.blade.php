<div class="card mb-3 shadow-sm overflow-hidden">
  <div class="row g-0 align-items-center"> <div class="col-md-4">
      <img src="{{ $restaurant->image_url }}" 
           alt="{{ $restaurant->name }}" 
           class="img-fluid rounded-start" 
           style="width: 100%; aspect-ratio: 16/9; object-fit: cover;">
    </div>
    
    <div class="col-md-8">
      <div class="card-body">
        <small class="text-muted">
            {{ $restaurant->location }} | <span class="fw-bold text-success">{{ $restaurant->price_symbol }}</span>
        </small>
        
        <h5 class="card-title fw-bold mb-1">{{ $restaurant->name }}</h5>
        
        <div class="mb-2 text-warning small">
            <span class="fw-bold text-dark me-1">{{ $restaurant->avg_rating }}</span>
            ★ <span class="text-muted">({{ $restaurant->total_reviews }})</span>
        </div>

        <p class="card-text text-secondary small">
            {{ Str::limit($restaurant->description, 80) }}
        </p>

        <a href="{{ route('restaurants.show', $restaurant->slug ?? $restaurant->id) }}" class="btn btn-sm btn-primary">
            Lihat Detail
        </a>
      </div>
    </div>
  </div>
</div>