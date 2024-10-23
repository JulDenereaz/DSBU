<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AcceptMember extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'acceptMember')
            ->label('Accept Member')
            ->icon('heroicon-o-check-circle')
            ->color(function ($record) {
                return 'secondary';
            })
            ->requiresConfirmation()
            ->modalHeading('Approve new Lab Member')
            ->modalDescription('')
            ->action(function ($record, Action $action) {


                $record->update([
                    'is_accepted' => true,
                ]);

                if ($record->hasRole('inactive')) {
                    $record->removeRole('inactive');
                }

                $record->assignRole('user');
            })
            ->visible(function ($record) {


                /** @var \App\Models\User */
                $user = Auth::user();
                return (!$record->is_accepted && $user->hasAnyRole(['admin', 'pi']));
            });
    }
}
