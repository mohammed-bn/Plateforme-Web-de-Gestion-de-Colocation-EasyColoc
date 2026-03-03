<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Http\Requests\StoreColocationRequest;
use App\Models\User;

class ColocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colocations = auth()->user()->colocations;

        return view('colocation.index', compact('colocations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colocation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColocationRequest $request)
    {
        $colocation = Colocation::create([
            'title' => $request->title,
        ]);

        $colocation->users()->attach(auth()->id(), [
            'role' => 'owner',
        ]);

        return redirect()->route('colocations.index')
            ->with('success', 'Colocation created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Colocation $colocation)
    {
        $colocation->load([
            'users' => function($query) {
                $query->withPivot(['role', 'joined_at', 'left_at']);
            },
            'categories',
            'expenses.payer',
            'expenses.category'
        ]);

        return view('colocation.show', compact('colocation'));
    }

    /**
     * Mark the authenticated user as having left the colocation.
     */
    public function leave(Colocation $colocation, ?User $user = null)
    {
        $user = $user ?? auth()->user();
        $colocation->users()->updateExistingPivot($user->id, [
            'left_at' => now(),
        ]);

        return redirect()->route('colocations.index')
            ->with('success', 'Vous avez quitté la colocation.');
    }

    public function inactif(Colocation $colocation)
    {
        $isOwner = $colocation->users()
            ->where('user_id', auth()->id())
            ->wherePivot('role', 'owner')
            ->exists();

        if (!$isOwner) {
            return redirect()->back()->with('error', 'Seul le propriétaire peut inactiver la colocation.');
        }

        $colocation->update([
            'status' => 'inactif',
        ]);

        return redirect()->route('colocations.index')
            ->with('success', 'La colocation est maintenant inactive.');
    }
}
