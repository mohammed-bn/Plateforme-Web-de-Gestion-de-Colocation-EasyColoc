<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Colocation extends Model
{
    /** @use HasFactory<\Database\Factories\ColocationFactory> */
    use HasFactory;
        protected $fillable = [
        'name',
        'email',
        'password',
        'reputation',
        'status', 
        ];

    protected $hidden = [
        'password',
        'remember_token', 
         ];

    protected function casts(): array
    {
        return [ 'password' => 'hashed',];
    }

    public function colocations(){
        return $this->hasMany(Colocation::class );
    }

    public function joins()
    {
        return $this->hasMany(Join::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function paidExpenses()
    {
        return $this->belongsToMany(Expense::class, 'payments')
            ->withPivot(['amount' , 'status' , 'paid_at'])->withTimestamps();
    }
}
