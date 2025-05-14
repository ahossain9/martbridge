<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // make a new Admin
        // check if the user is already exists
        $admin = Admin::where('email', 'admin@admin.com')->first();
        if (! $admin) {
            Admin::create([
                'first_name' => 'Admin',
                'last_name' => ' Admin',
                'email' => 'admin@admin.com',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'phone' => '1234567890',
            ]);
        }
    }
}
