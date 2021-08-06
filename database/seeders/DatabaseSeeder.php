<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // For now it's just a normal user
        if (! User::where('email', 'admin@admin.com')->first()) {
            $adminUser = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);

            Restaurant::factory()->create([
                'user_id' => $adminUser,
                'name' => 'Adminifoods',
            ]);

            // Can't use factory output. restaurant does not have an ID there
            $restaurant = $adminUser->restaurant;

            Reservation::factory(10)->create([
                'restaurant_id' => $restaurant,
            ]);
        }

        $restaurants = Restaurant::factory(10)->create();
        $restaurants = $restaurants->fresh();
        foreach($restaurants as $restaurant) {
            Reservation::factory(10)->create([
                'restaurant_id' => $restaurant,
            ]);
        }
    }
}
