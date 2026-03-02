<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // le premier user = role admin
        User::create([
            'name' => 'Admin Mohammed',
            'email' => 'admin-Mohammed@example.com',
            'password' => Hash::make('password'),
            'reputation' => 100,
            'status' => 'actif',
            'role' => 'admin',
        ]);

        // tout les utilisateurs (users) = defult role user normale
        User::factory(9)->create([
            'role' => 'user',
        ]);
    }
}
