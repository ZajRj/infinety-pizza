<?php

namespace App\Filament\Resources\Ingredients\Pages;

use App\Filament\Resources\Ingredients\IngredientResource;
use Filament\Resources\Pages\CreateRecord;
use App\Traits\RedirectsToIndex;

class CreateIngredient extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = IngredientResource::class;
}
