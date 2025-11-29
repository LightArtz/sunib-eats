<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:500', 
        ]);

        $existingReview = Review::where('user_id', Auth::id())
                                ->where('restaurant_id', $restaurant->id)
                                ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah pernah memberikan ulasan untuk restoran ini.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'restaurant_id' => $restaurant->id,
            'rating' => $validated['rating'],
            'content' => $validated['content'],
        ]);

        // Update rata-rata rating dan total review pada restoran
        $newAvgRating = $restaurant->reviews()->avg('rating');
        $newTotalReviews = $restaurant->reviews()->count();

        $restaurant->update([
            'avg_rating' => $newAvgRating,
            'total_reviews' => $newTotalReviews
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda berhasil ditambahkan.');
    }

    /**
     * @param  \Illuminate\Http\Request  
     * @param  \App\Models\Review  
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review->update($request->only('rating', 'comment'));

        return back()->with('success', 'Ulasan Anda berhasil diperbarui.');
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
