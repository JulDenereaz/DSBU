<?php

namespace App\Filament\Pages\Auth;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Auth\Events\Registered;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Register as BaseRegister;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;

class Register extends BaseRegister
{


    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (TooManyRequestsException $exception) {
            Notification::make()
                ->title(__('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]))
                ->body(array_key_exists('body', __('filament-panels::pages/auth/register.notifications.throttled') ?: []) ? __('filament-panels::pages/auth/register.notifications.throttled.body', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]) : null)
                ->danger()
                ->send();

            return null;
        }

        $data = $this->form->getState();
        $data['name'] = $data['firstname'] . ' ' . $data['lastname'];
//        $data['role'] = 'user';

        $user = $this->getUserModel()::create($data);

        // app()->bind(
        //     \Illuminate\Auth\Listeners\SendEmailVerificationNotification::class,
        //     \Filament\Listeners\Auth\SendEmailVerificationNotification::class,
        // );
        event(new Registered($user));

        Filament::auth()->login($user);

        session()->regenerate();
        
        return app(RegistrationResponse::class);
    }

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
            ->maxLength(255);
    }

    protected function getGroupNameFormComponent(): Component
    {
        return Select::make('group_name')
            ->options([
                'veening' => 'Veening',
                'lebrand' => 'Lebrand',
            ])
            ->default('veening')
            ->required();
    }
}