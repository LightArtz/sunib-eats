<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Promotion;
use App\Models\Restaurant;
use App\Services\RestaurantService;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(Request $request, RestaurantService $restaurantService)
    {
        $hotRestaurants = $restaurantService->getHotRestaurants(4);
        $hotIds = $hotRestaurants->pluck('id')->toArray();
        // Disini hot restaurant sudah diambil dari Service/RestaurantService.php

        $restaurants = Restaurant::query()
            ->whereNotIn('id', $hotIds)
            ->search($request->input('search'))
            ->filterByCategories($request->input('categories'))
            ->sortBy($request->input('sort'))
            ->paginate(8)
            ->withQueryString();
        // Semua logic disini diambil dari Business Logic di Model/Restaurant.php

        $promotions = Promotion::with('restaurant')->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();
        $categories = Category::all()->groupBy('type');

        return view('pages.dashboard', [
            'restaurants' => $restaurants,
            'hotRestaurants' => $hotRestaurants,
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
