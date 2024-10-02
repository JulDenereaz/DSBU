<?php

namespace App\Filament\Resources\ExperimentResource\Pages;

use App\Filament\Resources\ExperimentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;


class ListExperiments extends ListRecords
{
    protected static string $resource = ExperimentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make(),
            Tab::make('Incomplete')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Incomplete' ))
            ->icon('heroicon-s-pencil')
            ->iconPosition('before'),
            'Ready' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Ready' ))
            ->icon('heroicon-s-check-circle')
            ->iconPosition('before'),
            'Created' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Created' ))
            ->icon('heroicon-s-document')
            ->iconPosition('before'),
            'Archived' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Archived' ))
            ->icon('bi-archive-fill')
            ->iconPosition('before'),
            'Deleted' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'Deleted' ))
            ->icon('heroicon-s-trash')
            ->iconPosition('before'),
        ];
    }
}
