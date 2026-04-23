<?php

namespace App\Filament\Resources\Pizzas\Pages;

use App\Filament\Resources\Pizzas\PizzaResource;
use App\Traits\RedirectsToIndex;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditPizza extends EditRecord
{
    use RedirectsToIndex;

    protected static string $resource = PizzaResource::class;

    protected function afterSave(): void
    {
        $this->syncIngredients();
    }

    protected function syncIngredients(): void
    {
        $data = $this->form->getRawState();
        $allIngredientIds = [];

        foreach ($data as $key => $ids) {
            if (str_starts_with($key, 'ingredients_') && is_array($ids)) {
                $allIngredientIds = array_merge($allIngredientIds, $ids);
            }
        }

        $this->record->ingredients()->sync($allIngredientIds);
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
