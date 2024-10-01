<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProtocolResource\Pages;
use App\Filament\Resources\ProtocolResource\RelationManagers;
use App\Models\Protocol;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class ProtocolResource extends Resource
{
    protected static ?string $model = Protocol::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Experiment Manager';
    protected static ?int $navigationSort = 2;

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
                TextColumn::make('pr_name')
                ->label('Protocol Name'),
                TextColumn::make('description')
                ->label('Description'),
                TextColumn::make('user.username')
                ->label('Creator'),
                TextColumn::make('group.group_name')
                ->label('Research Group'),
                TextColumn::make('category')
                ->label('Category'),
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
            'index' => Pages\ListProtocols::route('/'),
            'create' => Pages\CreateProtocol::route('/create'),
            'edit' => Pages\EditProtocol::route('/{record}/edit'),
        ];
    }
}
