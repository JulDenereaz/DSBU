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
        $user = Auth::user();
        // $data_categories = Data_category::pluck('category', 'id')->unique()->toArray();
        return $form
            ->schema([
                TextInput::make('eq_name')
                ->label('Equipment Name')
                ->prefixIcon('tabler-microscope')
                ->required(),
                TextInput::make('platform')
                ->label('Institute/Department')
                ->default($user->group->group_name)
                ->readOnly()
                ->required(),
                TextInput::make('platform_name')
                ->label('Institute/Department')
                ->default($user->group->fullname)
                ->readOnly()
                ->required(),
                TextInput::make('location')
                ->label('Location')
                ->prefixIcon('zondicon-location')
                ->required(),
                TextInput::make('software')
                ->label('Software')
                ->required(),
                Select::make('data_category')
                ->options(Data_category::pluck('category', 'id')->unique()->toArray())
                ->searchable()
                ->required(),
                RichEditor::make('description')
                ->columnSpan('full')
                ->required(),
            ])
            ->columns(4);
    }

}
