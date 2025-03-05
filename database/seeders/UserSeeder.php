<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // create defaut admin user
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'is_admin' => 1,
            'password' => Hash::make('password')
        ]);

        // generate other 4 users with random product counts
        User::factory(4)->create()->each(function($user){
            $user->products()->createMany(
                Product::factory(rand(1, 5))->make()->toArray()
            );
        });
    }
}
