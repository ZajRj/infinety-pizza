<?php

namespace App\Filament\Resources\Customers\RelationManagers;

use App\OrderStatus;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('status')
                    ->label(__('orders.fields.status'))
                    ->options(collect(OrderStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->label()]))
                    ->required()
                    ->default(OrderStatus::PENDING->value),
                
                TextInput::make('total')
                    ->label(__('orders.fields.total'))
                    ->numeric()
                    ->prefix('$')
                    ->required()
                    ->readonly(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label(__('orders.fields.id'))
                    ->prefix('#'),
                
                TextColumn::make('status')
                    ->label(__('orders.fields.status'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof OrderStatus ? $state->label() : $state)
                    ->color(fn ($state) => match($state) {
                        OrderStatus::PENDING => 'warning',
                        OrderStatus::CONFIRMED => 'success',
                        OrderStatus::CANCELLED => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('total')
                    ->label(__('orders.fields.total'))
                    ->money('USD'),

                TextColumn::make('created_at')
                    ->label(__('orders.fields.created_at'))
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Remove create action if you want to force creation from the main Order resource
                // Or ensure it handles the user_id correctly.
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                //
            ]);
    }
}
