<?php

namespace App\Filament\Resources\ProtocolsResource\Pages;

use App\Filament\Resources\ProtocolsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProtocols extends ListRecords
{
    protected static string $resource = ProtocolsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
