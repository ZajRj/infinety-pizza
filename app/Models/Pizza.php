<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Pizza extends Model
{
    /** @use HasFactory<\Database\Factories\PizzaFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'images',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    protected function firstImage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->images[0] ?? null,
        );
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'pizza_ingredient');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
