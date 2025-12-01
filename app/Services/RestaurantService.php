<?php

namespace App\Services;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Collection;

class RestaurantService
{
    public function getHotRestaurants(int $limit = 4): Collection
    {
        $hotRestaurants = Restaurant::orderByDesc('hot_score')
            ->take($limit)
            ->get();

        if ($hotRestaurants->isEmpty() || $hotRestaurants->first()->hot_score == 0) {
            return Restaurant::orderByDesc('avg_rating')
                ->take($limit)
                ->get();
        }

        return $hotRestaurants;
    }
}
// Fungsinya adalah untuk mengambil hot restaurant