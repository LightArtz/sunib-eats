<?php

namespace App\Http\Controllers;

use App\Models\Food;
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

        $restaurants = Restaurant::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->paginate(10);

        $promotions = Promotion::with('restaurant')->get();

        return view('pages.dashboard', ['restaurants' => $restaurants, 'promotions' => $promotions]);
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load('foods', 'reviews.user');

        return view('restaurant.show', compact('restaurant'));
    }
}
