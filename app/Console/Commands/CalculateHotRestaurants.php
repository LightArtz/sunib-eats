<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Restaurant;

class CalculateHotRestaurants extends Command
{
    protected $signature = 'sunib:calculate-hot';
    protected $description = 'Menghitung skor restoran hot';

    public function handle()
    {
        $this->info('Sedang menghitung skor restoran...');

        $restaurants = Restaurant::withCount('reviews')->get();

        foreach ($restaurants as $resto) {
            // Rumus: Rating (70%) + Popularitas Review (30%)
            $ratingScore = $resto->avg_rating * 20;
            $reviewScore = min($resto->reviews_count, 50);

            $finalScore = ($ratingScore * 0.7) + ($reviewScore * 0.3);

            $resto->update([
                'hot_score' => $finalScore
            ]);
        }

        $this->info('Selesai! Hot Score berhasil diupdate.');
    }
}
// Untuk melakukan perhitungan logic, ini tidak dilakukan pada saat user render halaman
// melainkan dijalankan secara berkala menggunakan command ini agar performa lebih baik.