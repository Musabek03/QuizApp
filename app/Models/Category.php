<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $data)
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public $timestamps = true;

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }
}
