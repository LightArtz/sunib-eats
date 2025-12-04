@if(request()->hasAny(['search', 'categories', 'price']))
<div class="mb-4">
    <div class="small text-muted mb-2">Menampilkan hasil untuk:</div>
    
    <div class="d-flex flex-wrap gap-2">
        @if(request('search'))
        <span class="badge bg-white text-dark border shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-search text-secondary"></i> "{{ request('search') }}"
        </span>
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
        <span class="badge bg-white text-dark border shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-cash-stack text-success"></i> 
            {{ $priceLabels[request('price')] ?? 'Unknown' }}
        </span>
        @endif

        @if(request('categories'))
        <span class="badge bg-white text-dark border shadow-sm d-flex align-items-center gap-2">
            <i class="bi bi-tags-fill text-primary"></i> 
            {{ count(request('categories')) }} Kategori
        </span>
        @endif

        <a href="{{ url()->current() }}" class="btn btn-sm btn-link text-danger text-decoration-none p-0 ms-1" style="font-size: 0.8rem;">
            <i class="bi bi-x-circle"></i> Reset
        </a>
    </div>
</div>
@endif