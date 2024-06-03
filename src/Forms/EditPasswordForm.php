<?php

namespace TomatoPHP\FilamentAccounts\Forms;

use Filament\Forms;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class EditPasswordForm
{
    public static function get(): array
    {
        return [
            Forms\Components\Section::make(trans('filament-accounts::messages.update_password'))
                ->aside()
                ->description(trans('filament-accounts::messages.ensure_your_password'))
                ->schema([
                    Forms\Components\TextInput::make('Current password')
                        ->label(trans('filament-accounts::messages.current_password'))
                        ->password()
                        ->required()
                        ->currentPassword()
                        ->revealable(),
                    Forms\Components\TextInput::make('password')
                        ->label(trans('filament-accounts::messages.new_password'))
                        ->password()
                        ->required()
                        ->rule(Password::default())
                        ->autocomplete('new-password')
                        ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
                        ->live(debounce: 500)
                        ->same('passwordConfirmation')
                        ->revealable(),
                    Forms\Components\TextInput::make('passwordConfirmation')
                        ->label(trans('filament-accounts::messages.confirm_password'))
                        ->password()
                        ->required()
                        ->dehydrated(false)
                        ->revealable(),
                ]),
        ];
    }
}
