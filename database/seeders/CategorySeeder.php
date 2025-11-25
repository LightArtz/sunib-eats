<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('categories')->truncate();

        Schema::enableForeignKeyConstraints();

        $categories = [
            // Kategori Harga
            'pricy',
            'cheap',

            // Kategori Negara
            'indonesian',
            'chinese',
            'japanese',
            'korean',
            'american',
            'mexican',
            'italian',
            'thai',

            // Kategori Jenis Makanan
            'nasi',
            'ayam',
            'sapi',
            'babi',
            'bakmi',
            'seafood',
            'sayur',
            'soup',
            'soto',
            'ice cream',
            'bobba',
            'seblak',
            'pizza',

            // Kategori Acara
            'kerja',
            'nongkrong',

            // Kategori Waktu
            'snack',
            'sarapan',
            'malam',

            // Kategori Tempat
            'all you can eat',
            'restoran',
            'street food',
            'cafe',
            'dessert',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
