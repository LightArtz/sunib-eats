<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use App\Models\ReviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function store(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:500',
            'price_per_portion' => 'required|numeric|min:1000',
            'images' => ['nullable', 'array', 'max:3'],
            'images.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'images.max' => 'Maksimal hanya boleh mengupload 3 foto.',
            'images.*.max' => 'Ukuran setiap foto tidak boleh lebih dari 2MB.'
        ]);

        $existingReview = Review::where('user_id', Auth::id())
            ->where('restaurant_id', $restaurant->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah mereview tempat ini.');
        }

        DB::transaction(function () use ($request, $restaurant, $validated) {
            $review = Review::create([
                'user_id' => Auth::id(),
                'restaurant_id' => $restaurant->id,
                'rating' => $validated['rating'],
                'content' => $validated['content'],
                'price_per_portion' => $validated['price_per_portion'],
            ]);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $photo) {
                    $path = $photo->store('reviews', 'public');
                    ReviewImage::create([
                        'review_id' => $review->id,
                        'path' => $path
                    ]);
                }
            }

            $this->recalculateRestaurantStats($restaurant);
        });

        return back()->with('success', 'Ulasan dan foto berhasil ditambahkan!');
    }

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) abort(403);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $review, $validated) {
            $history = $review->edit_history ?? [];
            $history[] = [
                'date' => now()->toDateTimeString(),
                'old_content' => $review->content,
                'old_rating' => $review->rating,
            ];

            $review->update([
                'rating' => $validated['rating'],
                'content' => $validated['content'],
                'edited_at' => now(),
                'edit_history' => $history
            ]);

            $this->recalculateRestaurantStats($review->restaurant);
        });

        return back()->with('success', 'Ulasan berhasil diedit.');
    }

    private function recalculateRestaurantStats(Restaurant $restaurant)
    {
        $avgRating = $restaurant->reviews()->avg('rating');
        $avgPrice = $restaurant->reviews()->avg('price_per_portion');
        $totalReviews = $restaurant->reviews()->count();

        $restaurant->update([
            'avg_rating' => $avgRating,
            'avg_price' => $avgPrice,
            'total_reviews' => $totalReviews
        ]);
    }

    /**
     * @param  \App\Models\Review  
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $review->delete();

        return back()->with('success', 'Ulasan Anda berhasil dihapus.');
    }
}
