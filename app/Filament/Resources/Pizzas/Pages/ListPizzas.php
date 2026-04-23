<?php

namespace App\Filament\Resources\Pizzas\Pages;

use App\Filament\Resources\Pizzas\PizzaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPizzas extends ListRecords
{
    protected static string $resource = PizzaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
