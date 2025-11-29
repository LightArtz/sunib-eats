<?php

namespace App\Http\Controllers;

use App\Models\Category; 
use App\Models\Promotion;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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
            ->when($selectedCategories, function ($query, $categoryIds) {
                $categories = Category::whereIn('id', $categoryIds)->get();
                
                $groupedCategories = $categories->groupBy('type');
                
                foreach ($groupedCategories as $type => $cats) {
                    $ids = $cats->pluck('id');
                    
                    $query->whereHas('categories', function ($q) use ($ids) {
                        $q->whereIn('categories.id', $ids);
                    });
                }
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