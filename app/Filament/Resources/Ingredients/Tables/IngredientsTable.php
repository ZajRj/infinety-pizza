<?php

namespace App\Filament\Resources\Ingredients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IngredientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label(__('ingredients.fields.image'))
                    ->circular(),

                TextColumn::make('name')
                    ->label(__('ingredients.fields.name'))
                    ->searchable(),


                TextColumn::make('description')
                    ->label(__('ingredients.fields.description'))
                    ->searchable(),


                TextColumn::make('category.name')
                    ->label(__('ingredients.fields.ingredient_category_id'))
                    ->badge()
                    ->color('info'),

                TextColumn::make('created_at')
                    ->label(__('generic.fields.created_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label(__('generic.fields.updated_at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
