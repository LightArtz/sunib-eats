<?php

namespace Database\Seeders;

use App\Models\Promotion;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = Restaurant::all();

        if ($restaurants->count() > 0) {
            Promotion::create([
                'restaurant_id' => $restaurants->first()->id,
                'title' => 'Diskon Kemerdekaan 45%',
                'description' => 'Berlaku untuk semua menu merah putih.',
                'image' => 'https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=1000&auto=format&fit=crop',
                'start_date' => Carbon::now()->subDays(1),
                'end_date' => Carbon::now()->addDays(7),
            ]);

            Promotion::create([
                'restaurant_id' => $restaurants->last()->id,
                'title' => 'Buy 1 Get 1 Coffee',
                'description' => 'Khusus pengguna kartu kredit BCA.',
                'image' => 'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?q=80&w=1000&auto=format&fit=crop',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(30),
            ]);

            Promotion::create([
                'restaurant_id' => $restaurants->random()->id,
                'title' => 'Paket Hemat Mahasiswa 20k',
                'description' => 'Cukup tunjukkan kartu mahasiswa BINUS.',
                'image' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1000&auto=format&fit=crop',
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(14),
            ]);
        }
    }
}
