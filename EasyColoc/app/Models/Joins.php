<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Joins extends Model
{
    /** @use HasFactory<\Database\Factories\JoinsFactory> */
    use HasFactory;
    protected $fillable = [
        'joined_at',
        'left_at',
        'role',
        'user_id',
        'colocation_id',
    ];

    protected $casts = [
        'joined_at' => 'date',
        'left_at' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
