<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Project Name')
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Start Date')
                    ->displayFormat('Y-m')
                    ->placeholder('yyyy-mm')
                    ->native(false)
                    ->required(),
                DatePicker::make('end_date')
                    ->label('End Date')
                    ->displayFormat('Y-m')
                    ->placeholder('yyyy-mm')
                    ->native(false)
                    ->required(),
                TextInput::make('funding')
                    ->label('Funding Agencies')
            ])
            ->columns(4);
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Get the current authenticated user
        $user = Auth::user();

        // Automatically populate fields
        $data['group_id'] = $user->group_id;


        return $data;
    }
}
