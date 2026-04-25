<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('users.fields.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('users.fields.email'))
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('phone_number')
                    ->label(__('users.fields.phone_number'))
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('dni')
                    ->label(__('users.fields.dni'))
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_admin')
                    ->label(__('users.fields.is_admin'))
                    ->boolean()
                    ->sortable()
                    ->alignCenter(),
                TextColumn::make('email_verified_at')
                    ->label(__('users.fields.email_verified_at'))
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->placeholder('---')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label(__('users.fields.created_at'))
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_admin')
                    ->label(__('users.filters.is_admin')),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
