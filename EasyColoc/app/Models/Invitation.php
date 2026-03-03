<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /** @use HasFactory<\Database\Factories\InvitationFactory> */
    use HasFactory;

    protected $fillable = [
        'status',
        'token',
        'colocation_id',
    ];

    public function colocation()
    {
        return $this->belongsTo(Colocation::class );
    }

    public function isAccepted()
    {
        return $this->status === 'accepter' ;
    }

    public function isRefused()
    {
        return  $this->status === 'refuse';
    }

    public function isPending()
    {
        return $this->status === 'enattente';
    }
}
