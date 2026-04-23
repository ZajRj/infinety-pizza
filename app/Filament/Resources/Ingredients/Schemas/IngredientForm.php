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
                Section::make(__('ingredients.sections.details'))
                    ->description(__('ingredients.sections.details_description'))
                    ->icon('heroicon-m-information-circle')
                    ->schema([
                        Grid::make(12)
                        ->schema([
                            FileUpload::make('image')
                                ->label(__('ingredients.fields.image'))
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
                                    ->label(__('ingredients.fields.name'))
                                    ->required()
                                    ->maxLength(255)
                                    ->placeholder(__('ingredients.placeholders.name')),

                                Textarea::make('description')
                                    ->label(__('ingredients.fields.description'))
                                    ->rows(4)
                                    ->placeholder(__('ingredients.placeholders.description'))
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
