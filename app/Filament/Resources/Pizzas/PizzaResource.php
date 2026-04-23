<?php

namespace App\Filament\Resources\Pizzas;

use App\Filament\Resources\Pizzas\Pages\CreatePizza;
use App\Filament\Resources\Pizzas\Pages\EditPizza;
use App\Filament\Resources\Pizzas\Pages\ListPizzas;
use App\Filament\Resources\Pizzas\Schemas\PizzaForm;
use App\Filament\Resources\Pizzas\Tables\PizzasTable;
use App\Models\Pizza;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PizzaResource extends Resource
{
    protected static ?string $model = Pizza::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    public static function getNavigationGroup(): ?string
    {
        return __('generic.menu.managing');
    }

    public static function getModelLabel(): string
    {
        return __('pizzas.title');
    }

    public static function getPluralModelLabel(): string
    {
        return __('pizzas.plural');
    }

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PizzaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PizzasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPizzas::route('/'),
            'create' => CreatePizza::route('/create'),
            'edit' => EditPizza::route('/{record}/edit'),
        ];
    }
}
