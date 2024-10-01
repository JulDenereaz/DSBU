<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Filament\Resources\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Support\Enums\FontWeight;
use Filament\Pages\Actions\EditAction;

class ViewEquipment extends ViewRecord
{
    protected static string $resource = EquipmentResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make()
                ->schema([
                    TextEntry::make('eq_id')
                    ->label('Unique ID'),
                    TextEntry::make('eq_name')
                    ->label('Equipment Name'),
                    TextEntry::make('platform')
                    ->label('Platform'),
                    TextEntry::make('platform_name')
                    ->label('Platform Name'),
                    TextEntry::make('location')
                    ->label('Location'),
                    TextEntry::make('getDataCategory.data_category')
                    ->label('Data Category'),
                    TextEntry::make('software')
                    ->label('Software'),
                ]),
                Section::make('Description')
                ->schema([
                    TextEntry::make('description')
                    ->html(),
                ])
            ]);
    }
    
    
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(), // This adds the Edit button
        ];
    }

}
