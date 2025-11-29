<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('restaurants')->truncate();
        DB::table('category_restaurant')->truncate();
        Schema::enableForeignKeyConstraints();

        $restaurants = [
            [
                'name' => 'Sate Khas Senayan',
                'location' => 'Alam Sutera',
                'description' => 'Hidangan khas Indonesia dengan cita rasa otentik dan suasana premium.',
                'avg_rating' => 4.8,
                'avg_price' => 75000,
                'image_url' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1974&auto=format&fit=crop',
                'categories' => ['Indonesian', 'Sate', 'Restoran', 'Keluarga', 'Lunch', 'Dinner'] 
            ],
            [
                'name' => 'Pizza Hut',
                'location' => 'Gading Serpong',
                'description' => 'Restoran pizza keluarga favorit dengan berbagai pilihan topping dan pasta.',
                'avg_rating' => 4.2,
                'avg_price' => 60000,
                'image_url' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=2070&auto=format&fit=crop',
                'categories' => ['American', 'Pizza', 'Pasta', 'Restoran', 'Keluarga', 'Lunch', 'Western']
            ],
            [
                'name' => 'Sushi Tei',
                'location' => 'BSD',
                'description' => 'Restoran Jepang modern dengan sushi belt dan bahan-bahan segar.',
                'avg_rating' => 4.7,
                'avg_price' => 120000,
                'image_url' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?q=80&w=1974&auto=format&fit=crop',
                'categories' => ['Japanese', 'Seafood', 'Ikan', 'Restoran', 'Date Night', 'Luxury ($$$$)', 'Lunch']
            ],
            [
                'name' => 'McDonald\'s',
                'location' => 'Alam Sutera',
                'description' => 'Restoran cepat saji global dengan burger dan ayam goreng ikonik.',
                'avg_rating' => 4.1,
                'avg_price' => 45000,
                'image_url' => 'https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=2070&auto=format&fit=crop',
                'categories' => ['American', 'Burger', 'Ayam', 'Street Food', 'Nongkrong', 'Affordable ($$)', 'Snack Time']
            ],
            [
                'name' => 'Starbucks',
                'location' => 'Gading Serpong',
                'description' => 'Coffee shop populer untuk nongkrong dan bekerja.',
                'avg_rating' => 4.6,
                'avg_price' => 55000,
                'image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=1000&auto=format&fit=crop',
                'categories' => ['Coffee', 'Tea', 'Cake', 'Cafe', 'Nongkrong', 'Kerja / WFC', 'Pricy ($$$)']
            ],
        ];

        foreach ($restaurants as $item) {
            $newResto = Restaurant::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'location' => $item['location'],
                'description' => $item['description'],
                'avg_rating' => $item['avg_rating'],
                'avg_price' => $item['avg_price'],
                'image_url' => $item['image_url'],
                'approved' => true,
            ]);

            $priceCategoryName = '';
            if ($item['avg_price'] < 30000) $priceCategoryName = 'Cheap ($)';
            elseif ($item['avg_price'] < 50000) $priceCategoryName = 'Affordable ($$)';
            elseif ($item['avg_price'] < 100000) $priceCategoryName = 'Pricy ($$$)';
            else $priceCategoryName = 'Luxury ($$$$)';

            if (!in_array($priceCategoryName, $item['categories'])) {
                $item['categories'][] = $priceCategoryName;
            }

            $categoryIds = Category::whereIn('name', $item['categories'])->pluck('id');

            $newResto->categories()->attach($categoryIds);
        }
    }
}