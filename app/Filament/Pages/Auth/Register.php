<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register as BaseRegister;

use Filament\Facades\Filament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Auth\Events\Registered;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Component;
use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Illuminate\Support\Facades\Validator;
use Filament\Forms\Components\View; 
use Illuminate\Validation\Rule;
use App\Models\Group;  // Import your Group model

class Register extends BaseRegister
{


    public function register(): ?RegistrationResponse
    {
        try {
            $this->rateLimit(10);
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

        // Filament::auth()->login($user); //activate to directly login

        session()->regenerate();
        
        // return redirect()->route('filament.auth.login')
        //              ->with('status', 'Registration successful. Please log in.');
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