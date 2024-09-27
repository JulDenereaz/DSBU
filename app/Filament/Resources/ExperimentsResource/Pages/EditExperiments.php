<?php

namespace App\Filament\Resources\ExperimentsResource\Pages;

use App\Filament\Resources\ExperimentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExperiments extends EditRecord
{
    protected static string $resource = ExperimentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
