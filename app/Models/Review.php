<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'restaurant_id', 'content', 'rating',
        'price_per_portion', 'price_symbol_count',
        'edited_at', 'edit_history'
    ];

    protected $casts = [
        'edit_history' => 'array',
        'edited_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_review');
    }

    public function images()
    {
        return $this->hasMany(ReviewImage::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}