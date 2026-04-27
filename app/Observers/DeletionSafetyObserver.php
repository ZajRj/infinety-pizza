<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\IngredientCategory;
use App\Models\Ingredient;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class DeletionSafetyObserver
{
    /**
     * Handle the "deleting" event.
     */
    public function deleting(Model $model): bool
    {
        // 1. Protection for Pizza Categories
        if ($model instanceof Category && $model->pizzas()->exists()) {
            $this->notify(
                __('This category still has associated pizzas. Please reassign or delete them first.')
            );
            return false;
        }

        // 2. Protection for Ingredient Categories
        if ($model instanceof IngredientCategory && $model->ingredients()->exists()) {
            $this->notify(
                __('This category still has associated ingredients. Please reassign or delete them first.')
            );
            return false;
        }

        // 3. Protection for Ingredients
        if ($model instanceof Ingredient && $model->pizzas()->exists()) {
            $this->notify(
                __('This ingredient is still being used in one or more pizzas. Please remove it from the pizzas first.')
            );
            return false;
        }

        return true;
    }

    protected function notify(string $message): void
    {
        Notification::make()
            ->title(__('Operation Blocked'))
            ->body($message)
            ->danger()
            ->send();
    }
}
