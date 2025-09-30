<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // tambahkan atribut yang bisa diisi secara massal

    protected $fillable = [
        'title',
        'content',
        'price',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];
    // ini tujuannya biar selalu 2 angka dibelakang koma

    // masukkin ini sesuai dengan yang ada di controller

    // jika ada business logic masukkin disini

    // ini contoh kalau bikin sendiri functionnya
    public function capitalTitle($value)
    {
        return strtoupper($value);
    }

    public function discount($value)
    {
        return $value * 0.9; // diskon 10%
    }

    public function priceLabel()
    {
        return $this->price > 100000 ? 'Expensive' : 'Affordable';
    }

    // ini contoh kalau pake accessor, kalo mau pakai mutator tinggal ganti jadi set
    public function getCapitalTitleAttribute()
    {
        return strtoupper($this->title);
    }
    public function getDiscountedPriceAttribute()
    {
        return $this->price * 0.9;
    }
    public function getPriceLabelAttribute()
    {
        return $this->price > 100000 ? 'Expensive' : 'Affordable';
    }
}

// jadi di laravel ada yang namanya mutator dan accessor
// mutator itu setter versi laravel
// accessor itu getter versi laravel
// nah jadi kalau pakai mutator dan accessor itu dia akan langsung oromatis ke apply
// sedangkan kalau kita bikin sendiri kita harus manggilnya manual