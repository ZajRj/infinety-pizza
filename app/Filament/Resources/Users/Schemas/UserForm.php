<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('User Management')
                    ->tabs([
                        Tab::make(__('users.sections.personal_info'))
                            ->icon('heroicon-m-user')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label(__('users.fields.name'))
                                            ->required()
                                            ->maxLength(255),
                                        TextInput::make('email')
                                            ->label(__('users.fields.email'))
                                            ->email()
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->maxLength(255),
                                        TextInput::make('phone_number')
                                            ->label(__('users.fields.phone_number'))
                                            ->tel()
                                            ->maxLength(255),
                                        TextInput::make('dni')
                                            ->label(__('users.fields.dni'))
                                            ->required()
                                            ->maxLength(255),
                                        Textarea::make('address')
                                            ->label(__('users.fields.address'))
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Tab::make(__('users.sections.account_security'))
                            ->icon('heroicon-m-shield-check')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('password')
                                            ->label(__('users.fields.password'))
                                            ->password()
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->required(fn (string $context): bool => $context === 'create')
                                            ->maxLength(255)
                                            ->helperText(__('users.helpers.password_edit')),
                                        
                                        Toggle::make('is_admin')
                                            ->label(__('users.fields.is_admin'))
                                            ->helperText(__('users.helpers.admin_access'))
                                            ->required(),
                                      
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
