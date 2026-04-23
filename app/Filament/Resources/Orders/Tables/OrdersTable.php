<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use App\OrderStatus;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label(__('orders.fields.id'))
                    ->searchable()
                    ->sortable()
                    ->prefix('#'),

                TextColumn::make('user.name')
                    ->label(__('orders.fields.customer'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('status')
                    ->label(__('orders.fields.status'))
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state instanceof OrderStatus ? $state->label() : $state)
                    ->color(fn ($state) => match($state) {
                        OrderStatus::PENDING => 'warning',
                        OrderStatus::CONFIRMED => 'success',
                        OrderStatus::CANCELLED => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                TextColumn::make('total')
                    ->label(__('orders.fields.total'))
                    ->money('USD')
                    ->sortable(),

              

                TextColumn::make('created_at')
                    ->label(__('orders.fields.created_at'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(collect(OrderStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->label()])),
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make('changeStatus')
                        ->label(__('orders.fields.status'))
                        ->icon('heroicon-o-arrow-path')
                        ->color('info')
                        ->form([
                            Select::make('status')
                                ->label(__('orders.fields.status'))
                                ->options(collect(OrderStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->label()]))
                                ->required(),
                        ])
                        ->action(function (Order $record, array $data): void {
                            $record->update(['status' => $data['status']]);
                        }),
                    DeleteAction::make(),
                ])
            ]);
    }
}
