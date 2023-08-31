<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
    ];

    /**
     * @return HasMany
     */
    public function dishes(): HasMany {
        return $this->hasMany(Dish::class);
    }

    /**
     * @return HasMany
     */
    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
}
