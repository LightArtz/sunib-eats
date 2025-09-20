@extends('layouts.app')

{{-- You can push custom styles for this page to your layout's stack --}}
@push('styles')
<style>
    .hero {
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?q=80&w=1974&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        padding: 4rem 1rem;
    }
    .restaurant-card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        text-decoration: none;
        color: inherit;
        overflow: hidden; /* Ensures the container's rounded corners clip the image */
    }
    .restaurant-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15)!important;
    }
    
    /* New container to constrain the image */
    .card-img-container {
        height: 200px; /* Set a fixed height for the image area */
        /* overflow: hidden; Hide any part of the image that overflows the container */
    }

    /* Make the image fill its new container without distortion */
    .card-img-container .card-img-top {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Fix for large pagination arrows */
    .pagination svg {
        width: 1em; /* Reduces the width of the arrow icons */
        height: 1em; /* Reduces the height of the arrow icons */
    }
</style>
@endpush

@section('content')
    <div class="container-fluid p-0">
        {{-- Hero Section with Search --}}
        <div class="hero text-center text-white">
            <h1 class="display-4 fw-bold">Sunib Eats</h1>
            <p class="lead">Discover the best places to eat in Tangerang and beyond.</p>
            
            {{-- Search form that submits to the named route --}}
            <form action="{{ route('restaurants.index') }}" method="GET" class="mx-auto" style="max-width: 600px;">
                <div class="input-group mt-4">
                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Search by restaurant, cuisine, or area..." value="{{ request('search') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i> Search
                    </button>
                </div>
            </form>
        </div>

        {{-- Restaurant Grid Section --}}
        <div class="container my-5">
            <h2 class="mb-4">Featured Restaurants</h2>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                {{-- @forelse handles the loop and the case where the collection is empty. --}}
                @forelse ($restaurants as $restaurant)
                    {{-- By adding d-flex, the column becomes a flex container, allowing h-100 on the card to work reliably --}}
                    <div class="col d-flex">
                        {{-- The link is currently a placeholder as the show route is not defined yet --}}
                        <a href="#" class="card h-100 shadow-sm border-0 restaurant-card w-100">
                            {{-- Image is now wrapped in a container to control its boundaries --}}
                            <div class="card-img-container">
                                <img src="{{ $restaurant->image_url ?? 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Good_Food_Display_-_NCI_Visuals_Online.jpg/1920px-Good_Food_Display_-_NCI_Visuals_Online.jpg' }}" class="card-img-top" alt="{{ $restaurant->name }}">
                            </div>
                            <div class="card-body d-flex flex-column">
                                {{-- Top section of the card body --}}
                                <div>
                                    <h5 class="card-title fw-bold">{{ $restaurant->name }}</h5>
                                    <p class="card-text text-muted">
                                        <i class="bi bi-tag-fill"></i> {{ $restaurant->cuisine }} &middot; <i class="bi bi-geo-alt-fill"></i> {{ $restaurant->area }}
                                    </p>
                                </div>
                                
                                {{-- Bottom section of the card body, pushed to the end with mt-auto --}}
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="fw-bold text-warning">
                                        <i class="bi bi-star-fill"></i> {{ number_format($restaurant->rating, 1) }}
                                    </span>
                                    
                                    <span class="badge bg-light text-dark fs-6">{{ $restaurant->price_range }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    {{-- This message shows if no restaurants match the search or the array is empty. --}}
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <p class="mb-0">🍽️ No restaurants found matching your search. Please try again!</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            {{-- Pagination links will appear here automatically --}}
            <div class="mt-5 d-flex justify-content-center">
                {{-- This appends the current search query to the pagination links --}}
                {{ $restaurants->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
