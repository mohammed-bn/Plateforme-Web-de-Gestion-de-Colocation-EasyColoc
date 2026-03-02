<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Colocation;
use App\Models\Join;
use App\Models\Category;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Colocation::all()->each(function (Colocation $colocation) {

            $memberIds = Join::query()
                ->where('colocation_id', $colocation->id)
                ->pluck('user_id');

            Category::query()
                ->where('colocation_id', $colocation->id)
                ->get()
                ->each(function (Category $category) use ($memberIds) {

                    Expense::factory(4)->create([
                        'category_id' => $category->id,
                        'user_id' => $memberIds->random(),
                    ]);
                });
        });
    }
}
