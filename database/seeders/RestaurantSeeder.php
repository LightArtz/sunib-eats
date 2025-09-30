<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
                'resto_name' => 'Geprek Bensu',
                'resto_location' => 'BSD',
                'resto_rating' => 4.5,
                'resto_pict' => 'https://placehold.co/600x400/orange/white?text=Geprek+Bensu',
            ],
            [
                'resto_name' => 'Sate Khas Senayan',
                'resto_location' => 'Alam Sutera',
                'resto_rating' => 4.8,
                'resto_pict' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1974&auto=format&fit=crop',
            ],
            [
                'resto_name' => 'Pizza Hut',
                'resto_location' => 'Gading Serpong',
                'resto_rating' => 4.2,
                'resto_pict' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=2070&auto=format&fit=crop',
            ],
            [
                'resto_name' => 'Sushi Tei',
                'resto_location' => 'BSD',
                'resto_rating' => 4.7,
                'resto_pict' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?q=80&w=1974&auto=format&fit=crop',
            ],
            [
                'resto_name' => 'McDonald\'s',
                'resto_location' => 'Alam Sutera',
                'resto_rating' => 4.1,
                'resto_pict' => 'https://images.unsplash.com/photo-1561758033-d89a9ad46330?q=80&w=2070&auto=format&fit=crop',
            ],
            [
                'resto_name' => 'Starbucks',
                'resto_location' => 'Gading Serpong',
                'resto_rating' => 4.6,
                'resto_pict' => 'https://images.unsplash.com/photo-1559925393-8be0ec476acb?q=80&w=1974&auto=format&fit=crop',
            ],
        ];

        foreach ($restaurants as $restaurant) {
            Restaurant::create($restaurant);
        }
    }
}
