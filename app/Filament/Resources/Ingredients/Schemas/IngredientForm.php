<?php

namespace App\Filament\Resources\Ingredients\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
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
                                ->disk('public')
                                ->directory('ingredients')
                                ->columnSpan([
                                    'default' => 12,
                                    'sm' => 2,
                                ]),

                            Group::make([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label(__('ingredients.fields.name'))
                                            ->required()
                                            ->maxLength(255)
                                            ->placeholder(__('ingredients.placeholders.name')),

                                        Select::make('ingredient_category_id')
                                            ->label(__('ingredients.fields.ingredient_category_id'))
                                            ->relationship('category', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->required()
                                                    ->maxLength(255),
                                                Textarea::make('description'),
                                            ]),
                                    ]),

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
