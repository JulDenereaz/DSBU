<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EquipmentResource\Pages;
use App\Filament\Resources\EquipmentResource\RelationManagers;
use App\Models\Equipment;
use App\Models\Group;
use App\Models\Data_category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class EquipmentResource extends Resource
{
    protected static ?string $model = Equipment::class;

    protected static ?string $navigationIcon = 'tabler-microscope';
    protected static ?string $navigationGroup = 'Experiment Manager';
    protected static ?int $navigationSort = 4;

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
                TextColumn::make('eq_id')
                ->label('Unique ID'),
                TextColumn::make('eq_name')
                ->searchable()
                ->label('Equipment Name'),
                TextColumn::make('platform')
                ->searchable()
                ->label('Platform'),
                TextColumn::make('platform_name')
                ->searchable()
                ->label('Platform Name'),
                TextColumn::make('location')
                ->searchable()
                ->label('Location'),
                TextColumn::make('dataCategory.data_category')
                ->searchable()
                ->label('Data Category'),
                TextColumn::make('software')
                ->searchable()
                ->label('Software'),
                TextColumn::make('description')
                ->label('Description'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->groups([
                Tables\Grouping\Group::make('location')
                    ->label('Location')
                    ->collapsible(),
                Tables\Grouping\Group::make('dataCategory.data_category')
                    ->label('Data Category')
                    ->collapsible(),
            ]);;
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
            'index' => Pages\ListEquipments::route('/'),
            'create' => Pages\CreateEquipment::route('/create'),
            'view' => Pages\ViewEquipment::route('/{record}'),
            'edit' => Pages\EditEquipment::route('/{record}/edit'),
        ];
    }
}
