<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Colocation::all()->each(function (Colocation $colocation) {
            $memberIds = Join::query()->where('colocation_id', $colocation->id)->pluck('user_id');
            $categoryIds = Category::query()->where('colocation_id', $colocation->id)->pluck('id');
            Expense::query()->whereIn('category_id', $categoryIds)->get()->each(function (Expense $expense) use ($memberIds) {
                    $participants = $memberIds->shuffle()->take(min(4, $memberIds->count()));
                    foreach ($participants as $userId) {
                        Payment::factory()->create([
                            'expense_id' => $expense->id,
                            'user_id' => $userId,
                        ]);
                    }
                });
        });
    }
}
