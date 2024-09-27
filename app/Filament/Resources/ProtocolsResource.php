<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProtocolsResource\Pages;
use App\Filament\Resources\ProtocolsResource\RelationManagers;
use App\Models\Protocols;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class ProtocolsResource extends Resource
{
    protected static ?string $model = Protocols::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

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
                TextColumn::make('user_id')
                ->label('Creator'),
                TextColumn::make('category')
                ->label('Category')
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
            'create' => Pages\CreateProtocols::route('/create'),
            'edit' => Pages\EditProtocols::route('/{record}/edit'),
        ];
    }
}
