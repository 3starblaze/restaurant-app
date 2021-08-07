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

            Restaurant::factory()->hasReservations(10)->create([
                'user_id' => $adminUser,
                'name' => 'Adminifoods',
            ]);
        }

        Restaurant::factory(10)->hasReservations(10)->create();
    }
}
