<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if( config('app.env') !== 'production') {
            $this->call([
                RestaurantSeeder::class,
                DishSeeder::class,
            ]);
        }

        $this->call([RoleSeeder::class]);
    }
}
