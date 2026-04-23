<?php

namespace App\Filament\Resources\Categories\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;
use App\Traits\RedirectsToIndex;

class CreateCategory extends CreateRecord
{

    use RedirectsToIndex;

    protected static string $resource = CategoryResource::class;
}
