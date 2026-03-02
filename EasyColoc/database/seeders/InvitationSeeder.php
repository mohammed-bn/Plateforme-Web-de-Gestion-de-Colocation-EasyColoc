<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colocation;
use App\Models\Invitation;

class InvitationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        Colocation::all()->each(function (Colocation $colocation) {
            Invitation::factory(3)->create([
                'colocation_id' => $colocation->id,
            ]);
        });
    }
}
