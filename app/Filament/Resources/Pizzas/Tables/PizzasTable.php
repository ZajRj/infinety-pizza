<?php

namespace App\Filament\Resources\Pizzas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class PizzasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label(__('pizzas.fields.images'))
                    ->disk('public')
                    ->circular()
                    ->stacked()
                    ->limit(1),

                TextColumn::make('name')
                    ->label(__('pizzas.fields.name'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('price')
                    ->label(__('pizzas.fields.price'))
                    ->money('USD')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label(__('pizzas.fields.is_active'))
                    ->boolean()
                    ->sortable(),

                TextColumn::make('ingredients_count')
                    ->label(__('pizzas.fields.ingredients'))
                    ->counts('ingredients')
                    ->badge()
                    ->color('warning'),

                TextColumn::make('created_at')
                    ->label(__('generic.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
