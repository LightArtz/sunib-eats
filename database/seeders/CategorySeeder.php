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
            ['type' => 'price', 'name' => 'pricy'],
            ['type' => 'price', 'name' => 'cheap'],

            // Kategori Negara
            ['type' => 'country', 'name' => 'indonesian'],
            ['type' => 'country', 'name' => 'chinese'],
            ['type' => 'country', 'name' => 'japanese'],
            ['type' => 'country', 'name' => 'korean'],
            ['type' => 'country', 'name' => 'american'],
            ['type' => 'country', 'name' => 'mexican'],
            ['type' => 'country', 'name' => 'italian'],
            ['type' => 'country', 'name' => 'thai'],

            // Kategori Jenis Makanan
            ['type' => 'food_type', 'name' => 'nasi'],
            ['type' => 'food_type', 'name' => 'ayam'],
            ['type' => 'food_type', 'name' => 'sapi'],
            ['type' => 'food_type', 'name' => 'babi'],
            ['type' => 'food_type', 'name' => 'bakmi'],
            ['type' => 'food_type', 'name' => 'seafood'],
            ['type' => 'food_type', 'name' => 'sayur'],
            ['type' => 'food_type', 'name' => 'soup'],
            ['type' => 'food_type', 'name' => 'soto'],
            ['type' => 'food_type', 'name' => 'ice cream'],
            ['type' => 'food_type', 'name' => 'bobba'],
            ['type' => 'food_type', 'name' => 'seblak'],
            ['type' => 'food_type', 'name' => 'pizza'],

            // Kategori Acara
            ['type' => 'occasion', 'name' => 'kerja'],
            ['type' => 'occasion', 'name' => 'nongkrong'],

            // Kategori Waktu
            ['type' => 'time', 'name' => 'snack'],
            ['type' => 'time', 'name' => 'sarapan'],
            ['type' => 'time', 'name' => 'malam'],

            // Kategori Tempat
            ['type' => 'place', 'name' => 'all you can eat'],
            ['type' => 'place', 'name' => 'restoran'],
            ['type' => 'place', 'name' => 'street food'],
            ['type' => 'place', 'name' => 'cafe'],
            ['type' => 'place', 'name' => 'dessert'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
