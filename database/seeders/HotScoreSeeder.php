<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Seeder;

class HotScoreSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = Restaurant::withCount('reviews')->get();

        foreach ($restaurants as $resto) {
            $ratingScore = $resto->avg_rating * 20;
            $reviewScore = min($resto->reviews_count, 50);

            $finalScore = ($ratingScore * 0.7) + ($reviewScore * 0.3);

            $resto->update([
                'hot_score' => $finalScore
            ]);
        }
    }
}
