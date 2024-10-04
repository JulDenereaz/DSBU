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
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Support\Facades\Auth;
use App\Filament\Actions\GenerateReadme;


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
                    ->badge()
                    ->color(static function ($state): string {
                        return match ($state) {
                            'Incomplete' => 'warning',
                            'Archived' => 'tertiary',
                            'Ready' => 'success',
                            'Created' => 'secondary',
                            'Deleted' => 'danger',
                            default => 'gray',
                        };
                    })
                    ->icon(static function ($state): ?string {
                        return match ($state) {
                            'Incomplete' => 'heroicon-s-pencil',
                            'Archived' => 'bi-archive-fill',
                            'Ready' => 'heroicon-s-check-circle',
                            'Created' => 'heroicon-s-document',
                            'Deleted' => 'heroicon-s-trash',
                            default => null,
                        };
                    })
                    ->sortable()
                    ->iconPosition('before'),
                TextColumn::make('name')
                    ->label('Name'),
                TextColumn::make('collection_date')
                    ->label('Data Collection Date')
                    ->date('Y-m-d'),
                TextColumn::make('project.project_name')
                    ->label('Project'),
                TextColumn::make('dataSubcategory.dataCategory.data_category')
                    ->label('Data Type'),
                TextColumn::make('dataSubcategory.data_subcategory')
                    ->label('Data Sub-Type'),
                TextColumn::make('equipment.name')
                    ->label('Equipment'),
                TextColumn::make('protocol.protocol_name')
                    ->label('Protocol'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                GenerateReadme::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                /** @var \App\Models\User */
                $user = Auth::user();

                if (!$user->hasRole('admin')) {
                    $query->where('group_id', $user->group_id);
                }
            });
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
