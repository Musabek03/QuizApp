<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Collection extends Model
{
    use HasFactory;
    protected $table = 'collection';
    protected $fillable = [
        'category_id',
        'user_id',
        'name',
        'description',
        'code',
        'allowed_type',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
        return $this->hasMany(Question::class)->with('answers');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function allowedUsers()
    {
        $this->belongsToMany(
            related: User::class,
            table: 'allowed_users',
        );
    }

    public function  scopeSearch(Builder $builder, $search)
    {
        $builder ->where('name', 'like', "%{$search}%" )
            ->Orwhere('description', 'like', "%{$search}");
    }
}
