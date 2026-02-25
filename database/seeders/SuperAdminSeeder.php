<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        User::updateOrCreate(
                ['email' => 'admin@example.com'], // Prevent duplicates
                [
                    'name' => 'Super Admin',
                    'password' => Hash::make('password123'), // Change in production
                    'role' => 'super_admin',
                    'company_id' => null, // Super Admin = Global user
                ]
        );
    }
}
