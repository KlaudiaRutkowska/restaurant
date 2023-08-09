<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string $timestamps
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];
}
