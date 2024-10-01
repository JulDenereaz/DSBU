<?php

namespace App\Filament\Resources;

use App\Models\User;
use App\Models\Group;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Filters\SelectFilter;

class UserResource extends Resource
{   

    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

    public static function getLabel(): string
    {
        return 'Lab Member';
    }

    // Customize plural label
    public static function getPluralLabel(): string
    {
        return 'Lab Members';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('firstname')
                    ->label('First Name')
                    ->required(),
                TextInput::make('lastname')
                    ->label('Last Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->required(),
                TextInput::make('username')
                    ->label('Username')
                    ->required(),
                // Add other fields as needed
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname')
                ->label('First Name'),
                TextColumn::make('lastname')
                ->label('Last Name'),
                TextColumn::make('username')
                ->label('Username')
                ->sortable(),
                TextColumn::make('email')
                ->label('Email'),
                TextColumn::make('group.group_name')
                ->label('Research Group')
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
