<?php

namespace App\Models;

use App\Observers\DeletionSafetyObserver;
use App\Observers\MenuCacheObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([MenuCacheObserver::class, DeletionSafetyObserver::class])]
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    public function pizzas(): HasMany
    {
        return $this->hasMany(Pizza::class);
    }
}
