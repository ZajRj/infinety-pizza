<?php

namespace App\Filament\Resources\IngredientCategories\Pages;

use App\Filament\Resources\IngredientCategories\IngredientCategoryResource;
use App\Traits\RedirectsToIndex;
use Filament\Resources\Pages\CreateRecord;

class CreateIngredientCategory extends CreateRecord
{
    use RedirectsToIndex;

    protected static string $resource = IngredientCategoryResource::class;
}
