<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    public function run(): void
    {
        $restaurants = [
            [
                'name' => 'Sate Khas Senayan',
                'location' => 'Alam Sutera',
                'description' => 'Hidangan khas Indonesia dengan cita rasa otentik dan suasana premium.',
                'avg_rating' => 4.8,
                'avg_price' => 75000,
                'image_url' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Indonesian', 'Sate', 'Restoran', 'Keluarga', 'Lunch', 'Dinner']
            ],
            [
                'name' => 'Pizza Hut',
                'location' => 'Gading Serpong',
                'description' => 'Restoran pizza keluarga favorit dengan berbagai pilihan topping dan pasta.',
                'avg_rating' => 4.2,
                'avg_price' => 60000,
                'image_url' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=800&q=80',
                'categories' => ['American', 'Pizza', 'Pasta', 'Restoran', 'Keluarga', 'Lunch', 'Western']
            ],
            [
                'name' => 'Sushi Tei',
                'location' => 'BSD',
                'description' => 'Restoran Jepang modern dengan sushi belt dan bahan-bahan segar.',
                'avg_rating' => 4.7,
                'avg_price' => 120000,
                'image_url' => 'https://images.unsplash.com/photo-1579871494447-9811cf80d66c?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Japanese', 'Seafood', 'Ikan', 'Restoran', 'Date Night', 'Lunch']
            ],
            [
                'name' => 'McDonald\'s',
                'location' => 'Alam Sutera',
                'description' => 'Restoran cepat saji global dengan burger dan ayam goreng ikonik.',
                'avg_rating' => 4.1,
                'avg_price' => 45000,
                'image_url' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=800&q=80',
                'categories' => ['American', 'Burger', 'Ayam', 'Street Food', 'Nongkrong', 'Snack Time']
            ],
            [
                'name' => 'Starbucks',
                'location' => 'Gading Serpong',
                'description' => 'Coffee shop populer untuk nongkrong dan bekerja.',
                'avg_rating' => 4.6,
                'avg_price' => 55000,
                'image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Coffee', 'Tea', 'Cake', 'Cafe', 'Nongkrong', 'Kerja / WFC']
            ],
            [
                'name' => 'Bakmi GM',
                'location' => 'BSD',
                'description' => 'Bakmi populer dengan cita rasa khas dan pelayanan cepat.',
                'avg_rating' => 4.4,
                'avg_price' => 35000,
                'image_url' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Chinese', 'Bakmi', 'Ayam', 'Restoran', 'Lunch']
            ],
            [
                'name' => 'Ramen Ya!',
                'location' => 'Gading Serpong',
                'description' => 'Ramen hangat dengan kuah gurih autentik Jepang.',
                'avg_rating' => 4.3,
                'avg_price' => 55000,
                'image_url' => 'https://images.unsplash.com/photo-1591814468924-caf88d1232e1?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Japanese', 'Soup', 'Ikan', 'Restoran', 'Dinner']
            ],
            [
                'name' => 'Kintan Buffet',
                'location' => 'AEON BSD',
                'description' => 'All You Can Eat grill dengan daging premium.',
                'avg_rating' => 4.6,
                'avg_price' => 180000,
                'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Japanese', 'Sapi', 'All You Can Eat', 'Dinner']
            ],
            [
                'name' => 'Holycow Steak',
                'location' => 'Gading Serpong',
                'description' => 'Steak premium dengan harga terjangkau.',
                'avg_rating' => 4.5,
                'avg_price' => 90000,
                'image_url' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Western', 'Steak', 'Sapi', 'Restoran', 'Dinner']
            ],
            [
                'name' => 'KFC',
                'location' => 'Cipondoh',
                'description' => 'Ayam goreng cepat saji yang renyah dan gurih.',
                'avg_rating' => 4.0,
                'avg_price' => 40000,
                'image_url' => 'https://images.unsplash.com/photo-1513639776629-7b61b0ac49cb?q=80&w=1167&auto=format&fit=crop&w=800&q=80',
                'categories' => ['American', 'Ayam', 'Street Food', 'Snack Time']
            ],
            [
                'name' => 'Gyu Kaku',
                'location' => 'Alam Sutera',
                'description' => 'Restoran BBQ Jepang dengan pilihan daging wagyu.',
                'avg_rating' => 4.7,
                'avg_price' => 290000,
                'image_url' => 'https://images.unsplash.com/photo-1740895299299-fe11f57507dc?q=80&w=1170&auto=format&fit=crop&w=600&q=80',
                'categories' => ['Japanese', 'Sapi', 'Dinner']
            ],
            [
                'name' => 'Hachi Grill',
                'location' => 'Alam Sutera',
                'description' => 'Restoran BBQ Jepang all you can eat.',
                'avg_rating' => 4.7,
                'avg_price' => 300000,
                'image_url' => 'https://images.unsplash.com/photo-1494566942107-a6e23c42d69e?q=80&w=1171&auto=format&fit=crop&w=600&q=80',
                'categories' => ['Japanese', 'Sapi', 'Dinner']
            ],
            [
                'name' => 'Bakso Boedjangan',
                'location' => 'Serpong',
                'description' => 'Bakso kekinian dengan topping melimpah.',
                'avg_rating' => 4.2,
                'avg_price' => 30000,
                'image_url' => 'https://images.unsplash.com/photo-1687425973283-d0d266b73325?q=80&w=2070&auto=format&fit=crop&w=600&q=80',
                'categories' => ['Indonesian', 'Soup', 'Sapi', 'Street Food', 'Lunch']
            ],
            [
                'name' => 'Warunk Upnormal',
                'location' => 'Gading Serpong',
                'description' => 'Tempat nongkrong kekinian dengan menu indomie kreatif.',
                'avg_rating' => 4.1,
                'avg_price' => 25000,
                'image_url' => 'https://images.unsplash.com/photo-1612929633738-8fe44f7ec841?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Indonesian', 'Nongkrong', 'Cafe', 'Snack Time']
            ],
            [
                'name' => 'HokBen',
                'location' => 'BSD',
                'description' => 'Makanan cepat saji khas Jepang favorit keluarga.',
                'avg_rating' => 4.3,
                'avg_price' => 35000,
                'image_url' => 'https://images.unsplash.com/photo-1616645297079-dfaf44a6f977?q=80&w=1170&auto=format&fit=crop&w=600&q=80',
                'categories' => ['Japanese', 'Ayam', 'Restoran', 'Lunch']
            ],
            [
                'name' => 'Kopi Kenangan',
                'location' => 'Tangerang',
                'description' => 'Kopi susu kekinian dengan banyak varian.',
                'avg_rating' => 4.4,
                'avg_price' => 22000,
                'image_url' => 'https://images.unsplash.com/photo-1663569820326-fece03afdf1c?q=80&w=1064&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'categories' => ['Coffee', 'Tea', 'Snack Time', 'Nongkrong']
            ],
            [
                'name' => 'Waroeng Steak',
                'location' => 'Cikokol',
                'description' => 'Steak murah meriah yang digemari anak muda.',
                'avg_rating' => 4.0,
                'avg_price' => 30000,
                'image_url' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?auto=format&fit=crop&w=600&q=80',
                'categories' => ['Western', 'Steak', 'Dinner']
            ],
            [
                'name' => 'Upnormal Coffee Roasters',
                'location' => 'BSD',
                'description' => 'Cafe luas untuk kerja dengan kopi enak.',
                'avg_rating' => 4.3,
                'avg_price' => 40000,
                'image_url' => 'https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Coffee', 'Tea', 'Cake', 'Cafe', 'Kerja / WFC']
            ],
            [
                'name' => 'Shigeru Bento',
                'location' => 'Karawaci',
                'description' => 'Bento cepat saji untuk makan siang praktis.',
                'avg_rating' => 4.1,
                'avg_price' => 30000,
                'image_url' => 'https://images.unsplash.com/photo-1553621042-f6e147245754?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Japanese', 'Ayam', 'Lunch']
            ],
            [
                'name' => 'Raa Cha Suki',
                'location' => 'Supermall Karawaci',
                'description' => 'Suki dan grill dengan harga terjangkau.',
                'avg_rating' => 4.4,
                'avg_price' => 100000,
                'image_url' => 'https://images.unsplash.com/photo-1663559147132-8138438ef2a9?q=80&w=1170&auto=format&fit=crop&w=600&q=80',
                'categories' => ['Thai', 'Soup', 'Sayuran (Vegan)', 'Dinner']
            ],
            [
                'name' => 'Bebek Kaleyo',
                'location' => 'Cikokol',
                'description' => 'Bebek goreng renyah dengan sambal pedas.',
                'avg_rating' => 4.5,
                'avg_price' => 45000,
                'image_url' => 'https://images.unsplash.com/photo-1614926994586-d0a318165f26?q=80&w=1170&auto=format&fit=crop&w=800&q=80',
                'categories' => ['Indonesian', 'Bebek', 'Restoran', 'Dinner']
            ],
            [
                'name' => 'Martabak Orins',
                'location' => 'Gading Serpong',
                'description' => 'Martabak tipis kering dengan topping melimpah.',
                'avg_rating' => 4.2,
                'avg_price' => 30000,
                'image_url' => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Indonesian', 'Martabak', 'Snack Time']
            ],
            [
                'name' => 'Burger King',
                'location' => 'BSD',
                'description' => 'Burger flame-grilled dengan rasa smoky khas.',
                'avg_rating' => 4.3,
                'avg_price' => 50000,
                'image_url' => 'https://images.unsplash.com/photo-1571091718767-18b5b1457add?auto=format&fit=crop&w=800&q=80',
                'categories' => ['American', 'Burger', 'Ayam', 'Lunch', 'Snack Time']
            ],
            [
                'name' => 'J.CO Donuts & Coffee',
                'location' => 'Alam Sutera',
                'description' => 'Donat lembut dan kopi ringan untuk nongkrong.',
                'avg_rating' => 4.5,
                'avg_price' => 35000,
                'image_url' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Coffee', 'Tea', 'Cake', 'Cafe', 'Snack Time']
            ],
            [
                'name' => 'Teh Poci Nusantara',
                'location' => 'Tangerang Kota',
                'description' => 'Minuman teh tradisional dengan harga terjangkau.',
                'avg_rating' => 4.0,
                'avg_price' => 12000,
                'image_url' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=800&q=80',
                'categories' => ['Tea', 'Snack Time', 'Nongkrong']
            ]
        ];

        foreach ($restaurants as $item) {
            $newResto = Restaurant::create([
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'location' => $item['location'],
                'description' => $item['description'],
                'avg_rating' => $item['avg_rating'],
                'avg_price' => $item['avg_price'],
                'image_url' => $item['image_url'],
                'total_reviews' => rand(10, 100),
                'hot_score' => rand(0, 100),
                'approved' => true,
            ]);

            $categoriesToAttach = $item['categories'];

            $priceCategoryName = '';
            if ($item['avg_price'] < 30000) {
                $priceCategoryName = 'Cheap ($)';
            } elseif ($item['avg_price'] < 50000) {
                $priceCategoryName = 'Affordable ($$)';
            } elseif ($item['avg_price'] < 100000) {
                $priceCategoryName = 'Pricy ($$$)';
            } elseif ($item['avg_price'] < 250000) {
                $priceCategoryName = 'Premium ($$$$)';
            } else {
                $priceCategoryName = 'Luxury ($$$$$)';
            }
            $categoriesToAttach[] = $priceCategoryName;

            $categoryIds = Category::whereIn('name', $categoriesToAttach)->pluck('id');
            $newResto->categories()->attach($categoryIds);
        }
    }
}
