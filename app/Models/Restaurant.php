<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'location',
        'avg_rating',
        'avg_price',
        'total_reviews',
        'image_url',
        'approved',
        'hot_score',
    ];

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_restaurant');
    }

    public function getPriceSymbolAttribute()
    {
        $price = $this->avg_price;
        if ($price < 30000) return '$';
        if ($price < 50000) return '$$';
        if ($price < 100000) return '$$$';
        if ($price < 250000) return '$$$$';
        return '$$$$$';
    }

    public function scopeSearch(Builder $query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            $q->where(function ($subQ) use ($search) {
                $subQ->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        });
    }

    public function scopeFilterPrice(Builder $query, $level)
    {
        if (!$level) return $query;

        return $query->where(function ($q) use ($level) {
            if ($level == '1')      $q->where('avg_price', '<', 30000);
            elseif ($level == '2')  $q->whereBetween('avg_price', [30000, 49999]);
            elseif ($level == '3')  $q->whereBetween('avg_price', [50000, 99999]);
            elseif ($level == '4')  $q->whereBetween('avg_price', [100000, 249999]);
            elseif ($level == '5')  $q->where('avg_price', '>=', 250000);
        });
    }

    public function scopeFilterByCategories(Builder $query, $categories)
    {
        return $query->when($categories, function ($q) use ($categories) {
            $catsData = Category::whereIn('id', $categories)->get()->groupBy('type');

            foreach ($catsData as $type => $cats) {
                $ids = $cats->pluck('id');
                $q->whereHas('categories', function ($subQ) use ($ids) {
                    $subQ->whereIn('categories.id', $ids);
                });
            }
        });
    }

    public function scopeSortBy(Builder $query, $sort)
    {
        return $query->when($sort, function ($q) use ($sort) {
            if ($sort == 'rating_desc') return $q->orderByDesc('avg_rating');
            if ($sort == 'price_asc') return $q->orderBy('avg_price', 'asc');
            if ($sort == 'price_desc') return $q->orderByDesc('avg_price');
            if ($sort == 'newest') return $q->latest();
            return $q;
        }, function ($q) {
            return $q->inRandomOrder();
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
