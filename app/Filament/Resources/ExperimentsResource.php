<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperimentsResource\Pages;
use App\Filament\Resources\ExperimentsResource\RelationManagers;
use App\Models\Experiments;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class ExperimentsResource extends Resource
{
    protected static ?string $model = Experiments::class;

    protected static ?string $navigationIcon = 'heroicon-s-beaker';

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
                //
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
            'create' => Pages\CreateExperiments::route('/create'),
            'edit' => Pages\EditExperiments::route('/{record}/edit'),
        ];
    }
}
