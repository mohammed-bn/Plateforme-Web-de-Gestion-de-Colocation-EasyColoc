<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Expense;
use App\Http\Requests\StoreExpensesRequest;

class ExpenseController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpensesRequest $request, Colocation $colocation)
    {
        $request->validated();
        $expense = Expense::create([
            'amount'  => $request->amount,
            'title' => $request->title,
            'date' => $request->date,
            'category_id' => $request->category_id,
            'colocation_id' => $colocation->id,
            'payer_id' => auth()->id(),
        ]);

        $users = $colocation->users->count();
        $amountPerUser = $expense->amount / $users;

        foreach ($colocation->users as $user) {
            $expense->payments()->create([
                'user_id' => $user->id,
                'amount' => $amountPerUser,
                'paid_at' => $user->id == auth()->id() ? now() : null,
            ]);
        }

        return redirect()->back()->with('success', 'Dépense ajoutée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        if ($expense->payer_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Vous ne pouvez supprimer que vos propres dépenses.');
        }

        $expense->delete();
        return redirect()->back()->with('success', 'Dépense supprimée avec succès.');
    }
}
