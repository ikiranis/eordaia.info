<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // First, clear tables
        DB::table('users')->truncate();
        DB::table('roles')->truncate();

        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
