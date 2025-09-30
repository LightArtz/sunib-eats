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
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'restaurant_id' => $restaurant->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih! Ulasan Anda telah disimpan.');
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
