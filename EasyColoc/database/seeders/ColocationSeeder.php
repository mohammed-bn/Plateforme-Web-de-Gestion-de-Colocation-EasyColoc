<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colocation;
use App\Models\User;

class ColocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Colocation::factory(2)->create([
            'user_id' => $users->random()->id,
            'status' => 'actif',
        ]);
    }
}
