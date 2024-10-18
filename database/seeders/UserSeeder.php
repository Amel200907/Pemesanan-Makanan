<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (!User::where('email', 'admin@santapaja.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@santapaja.com',
                'password' => bcrypt('123'),
                'role' => 'admin',
            ]);
        }
        User::factory(10)->create();
    }
}
