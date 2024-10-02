<?php

namespace App\Filament\Resources\ExperimentResource\Pages;

use App\Filament\Resources\ExperimentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;
use App\Models\Group;
use App\Models\Project;
use App\Models\Protocol;
use App\Models\Data_category;
use Filament\Forms\Components\Wizard;

class CreateExperiment extends CreateRecord
{
    protected static string $resource = ExperimentResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Project')
                    ->schema([
                        Select::make('project_id')
                            ->options(function (callable $get) {
                                $user = Auth::user();
                        
                                return Project::where('group_id', $user->group_id)
                                    ->pluck('project_name', 'id');
                            })
                            ->searchable()
                            ->placeholder('Select a project')
                            ->prefixIcon('tabler-microscope')
                            ->required()
                            ->reactive(),

                        ]),
                    Wizard\Step::make('Equipment')
                    ->schema([
                        Select::make('data_category_id')
                            ->options(Data_category::pluck('data_category', 'id')->toArray())
                            ->label('Data Category')
                            ->searchable()
                            ->placeholder('Filter equipment by data category')
                            ->prefixIcon('tabler-filter')
                            ->reactive()
                            ->afterStateUpdated(function (callable $set) {
                                $set('equipment_id', null);
                            }),

                        Select::make('equipment_id')
                            ->label('Equipment')
                            ->options(function (callable $get) {
                                $query = Equipment::query();

                                if ($get('data_category_id')) {
                                    $query->where('data_category_id', $get('data_category_id'));
                                }

                                return $query->get()->mapWithKeys(function ($equipment) {
                                    return [
                                        $equipment->id => "{$equipment->eq_name} ({$equipment->platform}, {$equipment->location})"
                                    ];
                                })->toArray();
                            })
                            ->searchable()
                            ->placeholder('Select an equipment')
                            ->disabled(fn (callable $get) => !$get('data_category_id'))
                            ->prefixIcon('tabler-microscope')
                            ->required()
                            ->reactive(),

                    ]),
                    Wizard\Step::make('Protocol')
                    ->schema([
                        Select::make('protocol_id')
                            ->options(function (callable $get) {
                                $user = Auth::user();
                        
                                return Protocol::where('group_id', $user->group_id)
                                    ->pluck('protocol_name', 'id');
                            })
                            ->searchable()
                            ->placeholder('Select a project')
                            ->prefixIcon('tabler-microscope')
                            ->required()
                            ->reactive(),

                        ]),
                ])
            ]);
    }
}
