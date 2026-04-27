<?php

namespace App\Models;

use App\Observers\DeletionSafetyObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy(DeletionSafetyObserver::class)]
class IngredientCategory extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientCategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
    ];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
