<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('generic.sections.details'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('categories.fields.name'))
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label(__('categories.fields.slug'))
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Textarea::make('description')
                            ->label(__('categories.fields.description'))
                            ->maxLength(65535)
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label(__('categories.fields.is_active'))
                            ->default(true),
                    ])->columnSpanFull()->columns(2),
            ]);
    }
}
