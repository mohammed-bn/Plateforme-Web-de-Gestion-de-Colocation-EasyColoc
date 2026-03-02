<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colocation;
use App\Models\Join;
use App\Models\User;

class JoinsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        Colocation::all()->each(function (Colocation $colocation) use ($users) {
            $members = $users->random(4);

            foreach ($members as $member) {
                Join::firstOrCreate(
                    ['user_id' => $member->id, 'colocation_id' => $colocation->id],
                    ['role' => 'member', 'joined_at' => now()->subDays(rand(1, 30)), 'left_at' => null]
                );
            }
        });
    }
}
