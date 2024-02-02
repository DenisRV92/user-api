<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = 123456;

        $manager = User::create([
            'name' => "manager",
            'email' => 'manager@test.com',
            'role_id' => 1,
            'password' => bcrypt($password),
        ]);

        $user = User::create([
            'name' => "user",
            'email' => 'user@test.com',
            'role_id' => 2,
            'password' => bcrypt($password),
        ]);

        $manager->tokens()->create([
            'id' => 1,
            'name' => 'Personal Access Token',
            'token' => hash('sha256', 'manager_token123456'),
            'abilities' => ["*"],
        ]); ;
        $user->tokens()->create([
            'id' => 2,
            'name' => 'Personal Access Token',
            'token' => hash('sha256', 'user_token123456'),
            'abilities' => ["*"],
        ]); ;
        $user->createToken('user-token')->plainTextToken;
    }
}
