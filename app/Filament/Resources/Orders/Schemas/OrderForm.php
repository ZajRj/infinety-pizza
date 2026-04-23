<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Pizza;
use App\Models\User;
use App\OrderStatus;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make(__('orders.steps.details'))
                        ->description(__('orders.sections.summary_description'))
                        ->icon('heroicon-m-clipboard-document-list')
                        ->schema([
                            Grid::make(3)
                                ->schema([
                                    Select::make('user_id')
                                        ->label(__('orders.fields.customer'))
                                        ->relationship('user', 'name', fn($query) => $query->where('is_admin', false))
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->live(),

                                    Select::make('status')
                                        ->label(__('orders.fields.status'))
                                        ->options(collect(OrderStatus::cases())->mapWithKeys(fn ($status) => [$status->value => $status->label()]))
                                        ->required()
                                        ->default(OrderStatus::PENDING->value),

                                    TextInput::make('total')
                                        ->label(__('orders.fields.total'))
                                        ->numeric()
                                        ->prefix('$')
                                        ->placeholder('0.00')
                                        ->readonly()
                                        ->extraAttributes(['class' => 'font-bold text-primary-600']),
                                ]),
                        ]),

                    Step::make(__('orders.steps.items'))
                        ->description(__('orders.sections.items_description'))
                        ->icon('heroicon-m-shopping-cart')
                        ->schema([
                            Repeater::make('orderDetails')
                                ->label(__('orders.fields.items'))
                                ->relationship()
                                ->schema([
                                    Select::make('pizza_id')
                                        ->label(__('orders.fields.pizza'))
                                        ->relationship('pizza', 'name')
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(function ($state, $set, $get) {
                                            $price = Pizza::find($state)?->price ?? 0;
                                            $set('price', $price);
                                            static::updateTotal($get, $set);
                                        }),

                                    TextInput::make('price')
                                        ->label(__('orders.fields.unit_price'))
                                        ->numeric()
                                        ->prefix('$')
                                        ->required()
                                        ->live()
                                        ->afterStateUpdated(fn ($get, $set) => static::updateTotal($get, $set)),

                                    TextInput::make('observations')
                                        ->label(__('generic.fields.observations'))
                                        ->placeholder('e.g. No onions')
                                        ->maxLength(255)
                                        ->live(),
                                ])
                                ->columns(3)
                                ->defaultItems(1)
                                ->live()
                                ->afterStateUpdated(fn ($get, $set) => static::updateTotal($get, $set)),
                        ]),

                    Step::make(__('orders.steps.summary'))
                        ->description(__('orders.sections.summary_description'))
                        ->icon('heroicon-m-check-circle')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Placeholder::make('summary_customer')
                                        ->label(__('orders.fields.customer'))
                                        ->content(fn ($get) => User::find($get('user_id'))?->name ?? '-'),

                                    Placeholder::make('summary_total')
                                        ->label(__('orders.fields.total'))
                                        ->content(fn ($get) => '$ ' . number_format($get('total') ?? 0, 2))
                                        ->extraAttributes(['class' => 'text-2xl font-black text-primary-600']),
                                ]),

                            Placeholder::make('items_review')
                                ->label(__('orders.fields.items'))
                                ->content(fn ($get) => view('filament.orders.items-summary', [
                                    'items' => $get('orderDetails') ?? [],
                                ])),
                        ]),
                ])
                ->columnSpanFull(),
            ]);
    }

    public static function updateTotal($get, $set): void
    {
        // Inside repeater, we need to go up to find 'orderDetails'
        $items = $get('orderDetails') ?? $get('../../orderDetails') ?? [];
        $total = collect($items)->sum('price');
        
        // Update both levels to be sure
        $set('total', $total);
        $set('../../total', $total);
    }
}
