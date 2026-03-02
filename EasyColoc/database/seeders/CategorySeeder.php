<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Colocation;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Colocation::all()->each(function (Colocation $colocation) {
            Category::factory(3)->create([
                'colocation_id' => $colocation->id,
            ]);
        });
    }
}
