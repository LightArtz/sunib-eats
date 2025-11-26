<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            // Range Harga
            'price_range' => [
                'Cheap ($)',
                'Affordable ($$)',
                'Pricy ($$$)',
                'Luxury ($$$$)'
            ],

            // Asal Negara (Cuisine)
            'country' => [
                'Indonesian',
                'Chinese',
                'Japanese',
                'Korean',
                'American',
                'Mexican',
                'Italian',
                'Thai',
                'Western'
            ],

            // Bahan Utama (Daging/Sayur) - Sesuai request kamu
            'main_ingredient' => [
                'Ayam',
                'Sapi',
                'Babi (Non-Halal)',
                'Seafood',
                'Ikan',
                'Bebek',
                'Sayuran (Vegan)'
            ],

            // Jenis Hidangan (Dish Type)
            'dish_type' => [
                'Nasi',
                'Bakmi',
                'Soto',
                'Soup',
                'Pizza',
                'Pasta',
                'Burger',
                'Steak',
                'Seblak',
                'Sate',
                'Martabak'
            ],

            // Minuman & Dessert
            'dessert_drink' => [
                'Coffee',
                'Tea',
                'Bobba',
                'Ice Cream',
                'Cake',
                'Juice'
            ],

            // Suasana / Acara
            'occasion' => [
                'Nongkrong',
                'Kerja / WFC',
                'Date Night',
                'Keluarga',
                'Meeting'
            ],

            // Kategori Tempat
            'place_type' => [
                'Restoran',
                'Street Food',
                'Cafe',
                'All You Can Eat',
                'Bar / Lounge'
            ],

            // Waktu Makan
            'meal_time' => [
                'Sarapan',
                'Lunch',
                'Dinner',
                'Snack Time'
            ]
        ];

        foreach ($data as $type => $categories) {
            foreach ($categories as $name) {
                Category::create([
                    'type' => $type,
                    'name' => $name
                ]);
            }
        }
    }
}
