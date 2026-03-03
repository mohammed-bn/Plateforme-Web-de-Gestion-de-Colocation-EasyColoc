<?php

namespace App\Http\Controllers;

use App\Models\Colocation;
use App\Models\Invitation;
use App\Http\Requests\StoreInvitationRequest;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvitationRequest $request, Colocation $colocation)
    {
        $token = Str::random(16);
        Invitation::create([
            'colocation_id' => $colocation->id,
            'token' => $token,
        ]);
        return redirect()->route('colocations.show', $colocation)->with('success', 'Invitation created successfully : ' . $token);
    }
}
