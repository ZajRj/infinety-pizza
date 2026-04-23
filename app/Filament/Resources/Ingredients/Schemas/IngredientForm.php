<?php

namespace App\Filament\Resources\Ingredients\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class IngredientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ingredient Details')
                    ->description('General information and visual representation.')
                    ->icon('heroicon-m-information-circle')
                    ->schema([
                        Grid::make(12)
                        ->schema([
                            FileUpload::make('image')
                                ->image()
                                ->avatar()
                                ->imageEditor()
                                ->directory('ingredients')
                                ->columnSpan([
                                    'default' => 12,
                                    'sm' => 2,
                                ]),

                            Group::make([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder('e.g. Pepperoni'),

                                Textarea::make('description')
                                    ->rows(4)
                                    ->placeholder('Describe the ingredient...')
                                    ->columnSpanFull(),
                            ])->columnSpan([
                                'default' => 12,
                                'sm' => 10,
                            ]),
                        ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
