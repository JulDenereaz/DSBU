<?php

namespace App\Filament\Resources\ExperimentResource\Pages;

use App\Filament\Resources\ExperimentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Columns;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;
use App\Models\Group;
use App\Models\Project;
use App\Models\Protocol;
use App\Models\Data_category;
use App\Models\Data_subcategory;
use Filament\Forms\Components\Wizard;

class CreateExperiment extends CreateRecord
{
    protected static string $resource = ExperimentResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                    ->schema([

                        Wizard::make([
                            Wizard\Step::make('General Info')
                                ->schema([
                                    DatePicker::make('collection_date')
                                        ->label('Date of data collection')
                                        ->displayFormat('Y-m-d')
                                        ->format('Y-m-d')
                                        ->native(false)
                                        ->prefixIcon('bi-calendar-date')
                                        ->placeholder('YYYY-mm-dd')
                                        ->required(),
                                    Select::make('project_id')
                                        ->label('Project')
                                        ->options(function (callable $get) {
                                            $user = Auth::user();

                                            return Project::where('group_id', $user->group_id)
                                                ->pluck('project_name', 'id');
                                        })
                                        ->searchable()
                                        ->placeholder('Select a project')
                                        ->prefixIcon('carbon-document')
                                        ->required()
                                        ->reactive(),
                                ])
                                ->columns(2),
                            Wizard\Step::make('Protocol')
                                ->schema([
                                    Select::make('protocol_id')
                                        ->options(function (callable $get) {
                                            $user = Auth::user();

                                            return Protocol::where('group_id', $user->group_id)
                                                ->pluck('protocol_name', 'id');
                                        })
                                        ->searchable()
                                        ->placeholder('Select a protocol')
                                        ->prefixIcon('tabler-microscope')
                                        ->required()
                                        ->reactive(),
                                    RichEditor::make('samples')
                                        ->disableAllToolbarButtons()
                                        ->label('Samples (ID, Treatments)')
                                        ->placeholder('Sample description, with any strain IDs, or specific treatments that was used to adapt protocol to this experiment.'),
                                    RichEditor::make('description')
                                        ->disableAllToolbarButtons()
                                        ->label('Experiment description')
                                        ->placeholder('Brief summary of the experiment, to understand the general aim.'),
                                    TextInput::make('supp_table'),
                                ]),
                            Wizard\Step::make('Data acquisition')
                                ->schema([
                                    ToggleButtons::make('data_category_id')
                                        ->options(Data_category::pluck('data_category', 'id')->toArray())
                                        ->icons(
                                            Data_category::pluck('icon', 'id')->toArray()
                                        )
                                        ->label('Data Category')
                                        ->required()
                                        ->inline()
                                        ->reactive()
                                        ->afterStateUpdated(function (callable $set) {
                                            $set('equipment_id', null);
                                            $set('data_subcategory_id', null);
                                        })
                                        ->columnSpan(2),
                                    Select::make('data_subcategory_id')
                                        ->label(function (callable $get) {
                                            $dataCategoryId = $get('data_category_id');

                                            // If a data category is selected, get its name
                                            if ($dataCategoryId) {
                                                $dataCategory = Data_category::find($dataCategoryId);
                                                return $dataCategory ? 'Chose a ' . $dataCategory->data_category . ' data subcategory' : 'Data Subcategory';
                                            }

                                            return 'Data Subcategory';
                                        })
                                        ->options(function (callable $get) {
                                            // Only show subcategories that belong to the selected data_category_id
                                            if ($get('data_category_id')) {
                                                return Data_subcategory::where('data_category_id', $get('data_category_id'))
                                                    ->pluck('data_subcategory', 'id')
                                                    ->toArray();
                                            }

                                            return Data_subcategory::pluck('data_subcategory', 'id')->toArray();  // Default fallback
                                        })
                                        ->searchable()
                                        ->required()
                                        ->placeholder('Select a Data Subcategory')
                                        ->hidden(fn(callable $get) => !$get('data_category_id'))
                                        ->prefixIcon('carbon-category')
                                        ->reactive(),
                                    Select::make('equipment_id')
                                        ->label(function (callable $get) {
                                            $dataCategoryId = $get('data_category_id');

                                            // If a data category is selected, get its name
                                            if ($dataCategoryId) {
                                                $dataCategory = Data_category::find($dataCategoryId);
                                                return $dataCategory ? 'Chose a ' . $dataCategory->data_category . ' equipment' : 'Equipment';
                                            }

                                            return 'Equipment';
                                        })
                                        ->options(function (callable $get) {
                                            $query = Equipment::query();

                                            if ($get('data_category_id')) {
                                                $query->where('data_category_id', $get('data_category_id'));
                                            }

                                            return $query->get()->mapWithKeys(function ($equipment) {
                                                return [
                                                    $equipment->id => "{$equipment->name} ({$equipment->platform}, {$equipment->location})"
                                                ];
                                            })->toArray();
                                        })
                                        ->searchable()
                                        ->placeholder('Select an equipment')
                                        ->hidden(fn(callable $get) => !$get('data_subcategory_id'))
                                        ->prefixIcon(function (callable $get) {
                                            // Get the data_category_id from the form
                                            $dataCategoryId = $get('data_category_id');

                                            // If a data category is selected, find the corresponding icon
                                            if ($dataCategoryId) {
                                                $dataCategory = Data_category::find($dataCategoryId);

                                                // Return the corresponding icon if it exists
                                                return $dataCategory ? $dataCategory->icon : 'mdi-molecule';
                                            }

                                            // Default icon if no data category is selected
                                            return '';
                                        })
                                        ->required()
                                        ->reactive(),
                                ])
                                ->columns(2),
                            Wizard\Step::make('Metadata')
                                ->schema([
                                    
                                ])
                                ->columns(2),
                            Wizard\Step::make('Optional Details')
                                ->schema([
                                    Grid::make(1)
                                        ->schema([
                                            Toggle::make('is_personal')
                                                ->label('Personal Data')
                                                ->helperText('If Data contains personal data.'),
                                            Toggle::make('is_sensitive')
                                                ->label('Sensitive Data')
                                                ->helperText('Among the personal data, if it contains sensitive data.'),
                                            Toggle::make('is_encrypted')
                                                ->label('Encrypted Data')
                                                ->helperText('Are sensitive data encrypted.'),
                                        ])
                                        ->columnSpan(1),
                                    Grid::make(1)
                                        ->schema([
                                            TextInput::make('license')
                                                ->default('Under restricted access until publication and subsequently Under Creative Commons license CC BY')
                                                ->label('License')
                                                ->helperText('License applied to the data'),
                                            TextInput::make('storage_period')
                                                ->default('10 years')
                                                ->helperText('Specify if >10years')

                                        ])
                                        ->columnSpan(1),
                                ])
                                ->columns(2),
                            Wizard\Step::make('Summary')
                                ->schema([])
                        ])
                            ->extraAttributes(['class' => 'max-w-5xl'])
                            ->columnSpanFull()

                    ])
            ]);
    }
}
