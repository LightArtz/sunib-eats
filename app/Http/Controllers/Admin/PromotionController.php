<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Str;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Promotion::with('restaurant')->latest();

        // Search by Title or Restaurant Name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhereHas('restaurant', function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
        }

        $promotions = $query->paginate(10);
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurants = Restaurant::all();
        return view('admin.promotions.create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $result = cloudinary()->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'promotions'
            ]);
            $validated['image'] = $result['secure_url'];
        }

        Promotion::create($validated);

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        $restaurants = Restaurant::all();
        return view('admin.promotions.edit', compact('promotion', 'restaurants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($promotion->image) {
                if (Str::startsWith($promotion->image, 'http')) {
                    $publicId = 'promotions/' . pathinfo($promotion->image, PATHINFO_FILENAME);
                    cloudinary()->destroy($publicId);
                } else {
                    Storage::disk('cloudinary')->delete($promotion->image);
                }
            }
            $result = cloudinary()->uploadApi()->upload($request->file('image')->getRealPath(), [
                'folder' => 'promotions'
            ]);
            $validated['image'] = $result['secure_url'];
        }

        $promotion->update($validated);

        return redirect()->route('admin.promotions.index')->with('success', 'Promotion updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        if ($promotion->image) {
            if (Str::startsWith($promotion->image, 'http')) {
                $publicId = 'promotions/' . pathinfo($promotion->image, PATHINFO_FILENAME);
                cloudinary()->uploadApi()->destroy($publicId);
            } else {
                Storage::disk('cloudinary')->delete($promotion->image);
            }
        }
        $promotion->delete();
        
        return redirect()->route('admin.promotions.index')->with('success', 'Promotion deleted successfully.');
    }
}
