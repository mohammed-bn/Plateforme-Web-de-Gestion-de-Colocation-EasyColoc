<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Expenses extends Model
{
    /** @use HasFactory<\Database\Factories\ExpensesFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'amount',
        'status',
        'user_id',
        'category_id',
    ];

    protected $casts = [
        'amount' => 'integer',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'payments')
            ->withPivot(['amount', 'status', 'paid_at'])->withTimestamps();
    }
}
