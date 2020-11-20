<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'admin',
            'login' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt('admin1234'),
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'user',
            'login' => 'user',
            'email' => 'user@test.com',
            'password' => bcrypt('user1234'),
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'user2',
            'login' => 'user2',
            'email' => 'user2@test.com',
            'password' => bcrypt('user1234'),
        ]);
        User::create([
            'role_id' => 2,
            'name' => 'user3',
            'login' => 'user3',
            'email' => 'user3@test.com',
            'password' => bcrypt('user1234'),
        ]);
    }
}
