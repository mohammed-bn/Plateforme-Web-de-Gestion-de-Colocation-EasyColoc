<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'status',
    ];

    /**
     * Owner (creator) of the colocation
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'joins')
            ->withPivot(['joined_at', 'left_at', 'role'])->withTimestamps();
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function payments()
    {
        return $this->expenses
            ->map(fn($expense) => $expense->payments()->with('user')->where('paid_at', null)->get())
            ->flatten();
    }
}
