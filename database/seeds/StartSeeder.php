<?php

use Illuminate\Database\Seeder;

class StartSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
