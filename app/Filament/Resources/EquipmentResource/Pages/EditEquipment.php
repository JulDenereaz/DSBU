<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Filament\Resources\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Data_category;


class EditEquipment extends EditRecord
{
    protected static string $resource = EquipmentResource::class;
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('shortname')
                ->label('Shortname')
                ->prefixIcon('tabler-microscope')
                ->placeholder('Leica SP5 confocal')
                ->required(),
                TextInput::make('name')
                ->label('Name')
                ->prefixIcon('tabler-microscope')
                ->placeholder('Leica SP5 confocal')
                ->required(),
                TextInput::make('software')
                ->label('Software')
                ->required()
                ->placeholder('LasX')
                ->prefixIcon('tabler-app-window'),
                Select::make('data_category_id')
                ->options(Data_category::pluck('data_category', 'id')->unique()->toArray())
                ->label('Data Category')
                ->placeholder('Imaging')
                ->searchable()
                ->required()
                ->prefixIcon('tabler-category'),
                TextInput::make('location')
                ->label('Location')
                ->prefixIcon('zondicon-location')
                ->placeholder('Biophore')
                ->required(),
                RichEditor::make('description')
                ->columnSpan('full')
                ->required(),
            ])
            ->columns(4);
    }

    // Mutate the form data before creating the record
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Get the current authenticated user
        $user = Auth::user();

        // Retrieve the group associated with the user
        $group = $user->group;

        // Automatically populate fields
        $data['platform'] = $group->department;
        $data['platform_name'] =  $group->department_name;
        $data['creator_id'] = $user->id;
        $data['eq_id'] = $this->generateEqId(); // Generate eq_id or handle it as needed

        return $data;
    }

    // Example function to generate eq_id, customize as needed
    private function generateEqId(): string
    {
        // Get the current authenticated user
        $user = Auth::user();

        // Retrieve the group associated with the user
        $group = $user->group;
        $platformAbbreviation = $group->department;

        $lastEquipment = \App\Models\Equipment::where('platform', $platformAbbreviation)
            ->orderBy('eq_id')
            ->first();

        // If an equipment exists, extract the numeric part of the eq_id
        if ($lastEquipment && preg_match('/(\d+)$/', $lastEquipment->eq_id, $matches)) {
            // Increment the numeric part
            $nextNumber = intval($matches[1]) + 1;
        } else {
            // Start with 1 if no matching eq_id exists
            $nextNumber = 1;
        }

        // Format the new eq_id with leading zeros (e.g., DMF001, CIG001)
        $newEqId = $platformAbbreviation . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return $newEqId;
    }   

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
