<?php

namespace App\Filament\Resources\Pizzas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
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
                TrashedFilter::make(),
                SelectFilter::make('category_id')
                    ->label(__('pizzas.fields.category'))
                    ->relationship('category', 'name'),
                TernaryFilter::make('is_active')
                    ->label(__('pizzas.fields.is_active')),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                    RestoreAction::make(),
                    ForceDeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                ]),
            ]);
    }
}
