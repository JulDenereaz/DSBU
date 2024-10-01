<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperimentResource\Pages;
use App\Filament\Resources\ExperimentResource\RelationManagers;
use App\Models\Experiment;
use App\Models\User;
use App\Models\Protocol;
use App\Models\Equipment;
use App\Models\Group;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;


class ExperimentResource extends Resource
{
    protected static ?string $model = Experiment::class;

    protected static ?string $navigationIcon = 'heroicon-s-beaker';
    protected static ?string $navigationGroup = 'Experiment Manager';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'number';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('status')
                ->label('Status'),
                TextColumn::make('collection-date')
                ->label('Collection Date'),
                TextColumn::make('project.project_name')
                ->label('Project'),
                TextColumn::make('equipment.eq_name')
                ->label('Equipment'),
                TextColumn::make('protocol.pr_name')
                ->label('Protocol'),
                TextColumn::make('dataSubcategory.dataCategory.data_category')
                ->label('Data Type'),
                TextColumn::make('dataSubcategory.data_subcategory')
                ->label('Data Sub-Type'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperiments::route('/'),
            'create' => Pages\CreateExperiment::route('/create'),
            'edit' => Pages\EditExperiment::route('/{record}/edit'),
        ];
    }
}
