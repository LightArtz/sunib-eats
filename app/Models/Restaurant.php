<?php

namespace App\Models;

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
        'approved'
    ];

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getPriceSymbolAttribute()
    {
        $price = $this->avg_price;
        if ($price < 30000) return '$';
        if ($price < 50000) return '$$';
        if ($price < 100000) return '$$$';
        return '$$$$';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
