<?php

namespace App\Filament\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Storage;

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
                // Logic to generate the README file
                $readmeContent = "# " . $record->title . "\n\n" . $record->description;
                
                // Save the README file to storage
                Storage::disk('local')->put('readme.md', $readmeContent);

                // Notify the user of success
            })
            ->visible(fn ($record) => $record->status === 'Ready');
    }
}
