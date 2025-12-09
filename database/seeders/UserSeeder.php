<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Budi',
                'email' => 'budi@email.com',
                'password' => Hash::make('12341234'),
                'phone_number' => '081234567890',
                'date_of_birth' => '2002-05-15',
                'gender' => 'Male',
                'bio' => 'Hobi makan dan jalan-jalan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '081212346767',
                'role' => 'admin',
                'date_of_birth' => '2005-05-15',
                'gender' => 'Male',
                'bio' => 'Hobi makan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
