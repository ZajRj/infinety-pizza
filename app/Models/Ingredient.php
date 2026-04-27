<?php

namespace App\Models;

use App\Observers\DeletionSafetyObserver;
use App\Observers\MenuCacheObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([MenuCacheObserver::class, DeletionSafetyObserver::class])]
class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'ingredient_category_id',
    ];

    public function category()
    {
        return $this->belongsTo(IngredientCategory::class, 'ingredient_category_id');
    }

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'ingredient_pizza');
    }
}
