<?php

namespace App\Filament\Resources\ExperimentsResource\Pages;

use App\Filament\Resources\ExperimentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExperiments extends ListRecords
{
    protected static string $resource = ExperimentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
