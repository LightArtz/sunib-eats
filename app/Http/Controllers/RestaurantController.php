<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        // Static data array representing restaurant information
        $allRestaurants = [
            ['id' => 1, 'name' => 'Geprek Bensu', 'cuisine' => 'Indonesian', 'area' => 'BSD', 'rating' => 4.5, 'price_range' => '$'],
            ['id' => 2, 'name' => 'Sate Khas Senayan', 'cuisine' => 'Indonesian', 'area' => 'Alam Sutera', 'rating' => 4.8, 'price_range' => '$$', 'image_url' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1974&auto=format&fit=crop'],
            ['id' => 3, 'name' => 'Pizza Hut', 'cuisine' => 'Italian', 'area' => 'Gading Serpong', 'rating' => 4.2, 'price_range' => '$$', 'image_url' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=2070&auto=format&fit=crop'],
            ['id' => 4, 'name' => 'Sushi Tei', 'cuisine' => 'Japanese', 'area' => 'BSD', 'rating' => 4.7, 'price_range' => '$$$', 'image_url' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?q=80&w=1974&auto=format&fit=crop'],
            ['id' => 5, 'name' => 'McDonald\'s', 'cuisine' => 'Fast Food', 'area' => 'Alam Sutera', 'rating' => 4.1, 'price_range' => '$', 'image_url' => 'https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=2070&auto=format&fit=crop'],
            ['id' => 6, 'name' => 'Starbucks', 'cuisine' => 'Coffee', 'area' => 'Gading Serpong', 'rating' => 4.6, 'price_range' => '$$', 'image_url' => 'https://images.unsplash.com/photo-1559925393-8be0ec476acb?q=80&w=1974&auto=format&fit=crop'],
            ['id' => 7, 'name' => 'Warung Tekko', 'cuisine' => 'Indonesian', 'area' => 'BSD', 'rating' => 4.4, 'price_range' => '$$', 'image_url' => 'https://images.unsplash.com/photo-1626202243202-731362e26915?q=80&w=2070&auto=format&fit=crop'],
            ['id' => 8, 'name' => 'Marugame Udon', 'cuisine' => 'Japanese', 'area' => 'Alam Sutera', 'rating' => 4.9, 'price_range' => '$$', 'image_url' => 'https://images.unsplash.com/photo-1562967914-608f82629710?q=80&w=2070&auto=format&fit=crop'],
            ['id' => 9, 'name' => 'KFC', 'cuisine' => 'Fast Food', 'area' => 'Gading Serpong', 'rating' => 4.0, 'price_range' => '$', 'image_url' => 'https://images.unsplash.com/photo-1562967916-3a321c2c3567?q=80&w=2070&auto=format&fit=crop'],
        ];

        $collection = new Collection($allRestaurants);
        $search = $request->input('search');

        // Filter the collection if a search query exists
        $filtered = $search
            ? $collection->filter(function ($restaurant) use ($search) {
                return str_ireplace(' ', '', stristr($restaurant['name'], $search)) ||
                       str_ireplace(' ', '', stristr($restaurant['cuisine'], $search)) ||
                       str_ireplace(' ', '', stristr($restaurant['area'], $search));
            })
            : $collection;

        // Convert array to object for consistent access in Blade
        $filtered = $filtered->map(function ($item) {
            return (object) $item;
        });

        // Manually paginate the collection
        $perPage = 6;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageItems = $filtered->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedItems = new LengthAwarePaginator($currentPageItems, $filtered->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        
        return view('welcome', ['restaurants' => $paginatedItems]);
    }
}