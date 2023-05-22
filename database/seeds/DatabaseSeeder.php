<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    // php artisan db:seed
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminUserSeeder::class);
    }
}
