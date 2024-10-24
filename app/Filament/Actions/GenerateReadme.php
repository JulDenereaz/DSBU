<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class GenerateReadme extends Action
{
    public static function make(?string $name = null): static
    {
        return parent::make($name ?? 'generateReadme')
            ->label('Generate Readme')
            ->icon('heroicon-o-document-text')
            ->color(function($record) {
                return 'success';
            })
            ->action(function ($record, Action $action) {
                // Format the README content with record data
                $readmeContent = sprintf(
                    "# %s\n\n## Description:\n%s\n\n## Created At:\n%s\n\n## Status:\n%s",
                    $record->title,
                    $record->description,
                    $record->created_at->format('Y-m-d H:i'),
                    $record->status
                    
















                );

                $record->update([
                    'status' => 'CREATED',
                ]);

                // Return the file as a download response
                return Response::streamDownload(function () use ($readmeContent) {
                    echo $readmeContent;
                }, 'readme.txt');
            })
            ->visible(fn ($record) => $record->status !== 'Incomplete');
    }
}
