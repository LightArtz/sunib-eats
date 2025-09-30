<?php

namespace App\Http\Controllers;

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
                return $query->where('resto_name', 'like', "%{$search}%")
                    ->orWhere('resto_location', 'like', "%{$search}%");
            })
            ->paginate(6);

        return view('pages.home', ['restaurants' => $restaurants]);
    }

    public function show(Restaurant $restaurant)
    {
        $restaurant->load('foods', 'reviews.user');

        return view('restaurant.show', compact('restaurant'));
    }
}
