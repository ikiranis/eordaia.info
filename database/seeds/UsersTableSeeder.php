<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'rocean',
            'email' => 'rocean@error.gr',
            'password' => bcrypt('1111'),
            'role_id' => 1,
            'is_active' => 1
        ]);
    }
}
