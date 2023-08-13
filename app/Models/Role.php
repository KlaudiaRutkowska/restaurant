<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Date;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property Date|null $created_at
 * @property Date|null $updated_at
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
