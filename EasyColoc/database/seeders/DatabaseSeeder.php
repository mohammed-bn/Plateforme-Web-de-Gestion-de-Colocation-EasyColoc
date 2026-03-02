<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // apeller les class je ulitise
        $this->call([
            UsersSeeder::class,
            ColocationsSeeder::class,
            JoinsSeeder::class,
            CategoriesSeeder::class,
            ExpensesSeeder::class,
            PaymentsSeeder::class,
            InvitationsSeeder::class,
        ]);
    }
}
