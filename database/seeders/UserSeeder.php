<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        User::create([ 'name' => 'Admin', 'email' => 'admin@gmail.com', 'phone' => '1234567890', 'usertype' => 'admin', 'userstatus' => 'active', 'email_verified_at' => now(), 'password' => Hash::make('admin123'), 'current_team_id' => null, 'profile_photo_path' => null, ]);
    }
}
