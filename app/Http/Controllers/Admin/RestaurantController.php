<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Restaurant::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
        }

        $restaurants = $query->paginate(10);
        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all(); // Untuk dropdown select category
        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'avg_price' => 'required|numeric|min:0',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
        ]);

        // Handle Upload Gambar (Jika ada)
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('restaurants', 'public');
            $validated['image_url'] = $path;
        }

        // Generate Slug Otomatis
        $validated['slug'] = Str::slug($request->name);

        // Create Restaurant
        $restaurant = Restaurant::create($validated);

        // Sync Relasi Many-to-Many (Pivot Table: category_restaurant)
        if ($request->has('categories')) {
            $restaurant->categories()->sync($request->categories);
        }

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant registered successfully.');
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
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();

        // Load relasi categories agar checkbox bisa tercentang otomatis
        $restaurant->load('categories'); 
        return view('admin.restaurants.edit', compact('restaurant', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'avg_price' => 'required|numeric|min:0',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'approved' => 'boolean', // Admin bisa approve/reject
            'categories' => 'array',
        ]);

        // Handle Gambar Baru (Hapus yang lama jika ada)
        if ($request->hasFile('image_url')) {
            if ($restaurant->image_url && Storage::disk('public')->exists($restaurant->image_url)) {
                Storage::disk('public')->delete($restaurant->image_url);
            }
            $path = $request->file('image_url')->store('restaurants', 'public');
            $validated['image_url'] = $path;
        }

        $validated['slug'] = Str::slug($request->name);
        
        $restaurant->update($validated);

        if ($request->has('categories')) {
            $restaurant->categories()->sync($request->categories);
        }

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        // Hapus gambar dari storage saat data dihapus
        if ($restaurant->image_url && Storage::disk('public')->exists($restaurant->image_url)) {
            Storage::disk('public')->delete($restaurant->image_url);
        }
        
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant deleted successfully.');
    }
}
