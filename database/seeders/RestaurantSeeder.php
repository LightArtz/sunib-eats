<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str; // Wajib import ini untuk Slug

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('restaurants')->truncate();
        Schema::enableForeignKeyConstraints();

        $restaurants = [
            [
                'name' => 'Sate Khas Senayan',
                'location' => 'Alam Sutera',
                'description' => 'Hidangan khas Indonesia dengan cita rasa otentik dan suasana premium.',
                'avg_rating' => 4.8,
                'avg_price' => 75000,
                'image_url' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1974&auto=format&fit=crop',
            ],
            [
                'name' => 'Pizza Hut',
                'location' => 'Gading Serpong',
                'description' => 'Restoran pizza keluarga favorit dengan berbagai pilihan topping dan pasta.',
                'avg_rating' => 4.2,
                'avg_price' => 60000,
                'image_url' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=2070&auto=format&fit=crop',
            ],
            [
                'name' => 'Sushi Tei',
                'location' => 'BSD',
                'description' => 'Restoran Jepang modern dengan sushi belt dan bahan-bahan segar.',
                'avg_rating' => 4.7,
                'avg_price' => 120000,
                'image_url' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?q=80&w=1974&auto=format&fit=crop',
            ],
            [
                'name' => 'McDonald\'s',
                'location' => 'Alam Sutera',
                'description' => 'Restoran cepat saji global dengan burger dan ayam goreng ikonik.',
                'avg_rating' => 4.1,
                'avg_price' => 45000,
                'image_url' => 'https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=2070&auto=format&fit=crop',
            ],
            [
                'name' => 'Starbucks',
                'location' => 'Gading Serpong',
                'description' => 'Coffee shop populer untuk nongkrong dan bekerja.',
                'avg_rating' => 4.6,
                'avg_price' => 55000,
                'image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=1000&auto=format&fit=crop',
            ],
        ];

        foreach ($restaurants as $item) {
            Restaurant::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'location' => $item['location'],
                'description' => $item['description'],
                'avg_rating' => $item['avg_rating'],
                'avg_price' => $item['avg_price'],
                'image_url' => $item['image_url'],
                'approved' => true,
            ]);
        }
    }
}
