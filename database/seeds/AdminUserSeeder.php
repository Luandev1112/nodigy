<?php

use Illuminate\Database\Seeder;
use App\User;
   
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // php artisan db:seed --class=AdminUserSeeder
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => bcrypt('123456'),
            'is_verify' => 1,
            'role_type' => 1,
            'status' => 1,
        ]);
    }
}
