<?php

namespace Database\Seeders;

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
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        \App\Models\Restaurant::factory()->create([
            'user_id' => $adminUser,
            'name' => 'Adminifoods',
        ]);
        \App\Models\Restaurant::factory(10)->create();
    }
}
