<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Promotion;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort');
        $selectedCategories = $request->input('categories');

        $restaurants = Restaurant::query()
            // Search Logic
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%");
                });
            })
            // Filter Logic
            ->when($selectedCategories, function ($query, $categories) {
                return $query->whereHas('categories', function ($q) use ($categories) {
                    $q->whereIn('categories.id', $categories);
                });
            })
            // Sort Logic
            ->when($sort, function ($query, $sort) {
                if ($sort == 'rating_desc') return $query->orderByDesc('avg_rating');
                if ($sort == 'price_asc') return $query->orderBy('avg_price', 'asc');
                if ($sort == 'price_desc') return $query->orderByDesc('avg_price');
                if ($sort == 'newest') return $query->latest();
                return $query;
            })
            ->when(!$sort, function ($query) {
                return $query->latest();
            })
            ->paginate(10)
            ->withQueryString();

        $promotions = Promotion::with('restaurant')->get();

        $categories = Category::all()->groupBy('type');

        return view('pages.dashboard', [
            'restaurants' => $restaurants,
            'promotions' => $promotions,
            'categories' => $categories
        ]);
    }
    public function show(Restaurant $restaurant)
    {
        $restaurant->load(['promotions' => function ($query) {
            $query->active();
        }, 'reviews.user']);

        return view('components.restaurant-detail', compact('restaurant'));
    }
}
