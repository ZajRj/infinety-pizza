<?php

namespace App\Filament\Resources\Pizzas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PizzaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Pizza Management')
                    ->tabs([
                        Tab::make(__('pizzas.sections.details'))
                            ->icon('heroicon-m-information-circle')
                            ->schema([
                                Grid::make(12)
                                    ->schema([
                                        FileUpload::make('images')
                                            ->label(__('pizzas.fields.images'))
                                            ->multiple()
                                            ->image()
                                            ->imageEditor()
                                            ->panelLayout('grid')
                                            ->reorderable()
                                            ->directory('pizzas')
                                            ->columnSpan([
                                                'default' => 12,
                                                'md' => 4,
                                            ]),

                                        Group::make([
                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('name')
                                                        ->label(__('pizzas.fields.name'))
                                                        ->required()
                                                        ->maxLength(255)
                                                        ->placeholder(__('pizzas.placeholders.name')),

                                                    TextInput::make('price')
                                                        ->label(__('pizzas.fields.price'))
                                                        ->numeric()
                                                        ->prefix('$')
                                                        ->required()
                                                        ->placeholder(__('pizzas.placeholders.price')),
                                                ]),

                                            Toggle::make('is_active')
                                                ->label(__('pizzas.fields.is_active'))
                                                ->default(true),

                                            Textarea::make('description')
                                                ->label(__('pizzas.fields.description'))
                                                ->rows(3)
                                                ->placeholder(__('pizzas.placeholders.description'))
                                                ->columnSpanFull(),
                                        ])->columnSpan([
                                            'default' => 12,
                                            'md' => 8,
                                        ]),
                                ]),
                            ]),

                        Tab::make(__('pizzas.sections.recipe'))
                            ->icon('heroicon-m-beaker')
                            ->schema([
                                Grid::make(2)
                                    ->schema(function () {
                                        $categories = \App\Models\IngredientCategory::whereHas('ingredients')->get();
                                        
                                        return $categories->map(function ($category) {
                                            return Section::make($category->name)
                                                ->description($category->description)
                                                ->compact()
                                                ->schema([
                                                    CheckboxList::make("ingredients_{$category->id}")
                                                        ->hiddenLabel()
                                                        ->options(
                                                            \App\Models\Ingredient::where('ingredient_category_id', $category->id)
                                                                ->pluck('name', 'id')
                                                        )
                                                        ->afterStateHydrated(function ($component, $record) use ($category) {
                                                            if (!$record) return;
                                                            $component->state(
                                                                $record->ingredients()
                                                                    ->where('ingredient_category_id', $category->id)
                                                                    ->pluck('ingredients.id')
                                                                    ->toArray()
                                                            );
                                                        })
                                                        ->bulkToggleable(),
                                                ])
                                                ->columnSpan(1);
                                        })->toArray();
                                    }),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
