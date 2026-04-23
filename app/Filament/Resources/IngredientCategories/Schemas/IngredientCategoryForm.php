<?php

namespace App\Filament\Resources\IngredientCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IngredientCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('ingredient_categories.sections.details'))
                    ->description(__('ingredient_categories.sections.details_description'))
                    ->icon('heroicon-m-tag')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('ingredient_categories.fields.name'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        
                        Textarea::make('description')
                            ->label(__('ingredient_categories.fields.description'))
                            ->rows(5)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
