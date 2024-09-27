<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;
use App\Models\Group;  // Import your Group model

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getFirstNameFormComponent(),
                        $this->getLastNameFormComponent(),
                        $this->getUserNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                        $this->getGroupNameFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }


    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('firstname')
            ->label('First Name')
            ->required()  
            ->maxLength(255);
    }
    protected function getLastNameFormComponent(): Component
    {
        return TextInput::make('lastname')
            ->label('Last Name')
            ->required()
            ->maxLength(255);
    }

    protected function getUserNameFormComponent(): Component
    {
        return TextInput::make('username')
            ->label('Username')
            ->required()
            ->rules([
                'required',
                'string',
                'max:8',
                Rule::unique('users', 'username'), 
            ]);
    }

    protected function getGroupNameFormComponent(): Component
{
    $groups = Group::pluck('group_name', 'id')->toArray(); 

    return Select::make('group_id')
        ->options($groups)
        ->label('Select Group')
        ->required();
}
}