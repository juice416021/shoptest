<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [
            'id' => 1,
            'name' => 'admin測試',
            'email' => 'admintest@gmail.com',
            'email_verified_at' => '2023-04-04 02:08:12',
            'password' => '$2y$10$sOXEZYiXdNitO/CVkDEJsOwnqG19GYr.XUz84vB7qYBq14qPV7uBi',
            'facebook_id' => NULL,
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'role' => 'admin',
            'created_at' => '2023-04-10 16:14:34',
            'updated_at' => '2023-04-10 16:14:34',
        ],
        [
            'id' => 1,
            'name' => 'user測試',
            'email' => 'usertest@gmail.com',
            'email_verified_at' => '2023-04-04 02:08:12',
            'password' => '$2y$10$odK0atpPUy48FiljONEmw.U7Mgm2x00uemcMNBhpjOmeLcDh4rnCa',
            'facebook_id' => NULL,
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'role' => 'user',
            'created_at' => '2023-04-10 16:14:34',
            'updated_at' => '2023-04-10 16:14:34',
        ]
        ]);
    }
}
