<?php

namespace App\Filament\Resources\EquipmentResource\Pages;

use App\Filament\Resources\EquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Data_category;

class CreateEquipment extends CreateRecord
{
    protected static string $resource = EquipmentResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('eq_name')
                    ->label('Equipment Name')
                    ->prefixIcon('tabler-microscope')
                    ->required(),
                TextInput::make('location')
                    ->label('Location')
                    ->prefixIcon('zondicon-location')
                    ->required(),
                TextInput::make('software')
                    ->label('Software')
                    ->required()
                    ->prefixIcon('tabler-app-window'),
                Select::make('data_category_id')
                    ->options(Data_category::pluck('data_category', 'id')->unique()->toArray())
                    ->label('Data Category')
                    ->searchable()
                    ->required()
                    ->prefixIcon('tabler-category'),
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
        return uniqid('eq_', true);
    }
}
