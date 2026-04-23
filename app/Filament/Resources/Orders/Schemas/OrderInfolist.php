<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\OrderStatus;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('orders.sections.summary'))
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('id')
                                    ->label(__('orders.fields.id'))
                                    ->prefix('#'),

                                TextEntry::make('user.name')
                                    ->label(__('orders.fields.customer')),

                                TextEntry::make('status')
                                    ->label(__('orders.fields.status'))
                                    ->badge()
                                    ->formatStateUsing(fn ($state) => $state instanceof OrderStatus ? $state->label() : $state)
                                    ->color(fn ($state) => match($state) {
                                        OrderStatus::PENDING => 'warning',
                                        OrderStatus::CONFIRMED => 'success',
                                        OrderStatus::CANCELLED => 'danger',
                                        default => 'gray',
                                    }),

                                TextEntry::make('total')
                                    ->label(__('orders.fields.total'))
                                    ->money('USD'),

                                TextEntry::make('created_at')
                                    ->label(__('orders.fields.created_at'))
                                    ->dateTime(),
                            ]),
                    ]),

                Section::make(__('orders.sections.items'))
                    ->schema([
                        RepeatableEntry::make('orderDetails')
                            ->label(__('orders.fields.items'))
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextEntry::make('pizza.name')
                                            ->label(__('orders.fields.pizza')),

                                        TextEntry::make('price')
                                            ->label(__('orders.fields.unit_price'))
                                            ->money('USD'),

                                        TextEntry::make('observations')
                                            ->label(__('generic.fields.observations'))
                                            ->placeholder('None'),
                                    ]),
                            ])
                            ->columns(1),
                    ]),
            ]);
    }
}
