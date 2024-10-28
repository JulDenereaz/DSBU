<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use App\Models\Group;
use App\Models\User;
use Filament\Forms;
use Carbon\Carbon;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Experiment Manager';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('users')
                    ->label('Assign Members')
                    // ->options(User::all()->pluck('name', 'id'))
                    ->multiple()
                    ->relationship('users', 'username') // The relationship and the display column from the users table
                    ->searchable(), // Allow search inside the select dropdown

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Project Name'),
                TextColumn::make('funding')
                    ->label('Funding Agencies'),
                    TextColumn::make('start_date')
                    ->label('Project Dates (YYYY-MM)')
                    ->formatStateUsing(function (Project $project) {
                        $startDate = Carbon::parse($project->start_date)->format('Y-m');
                        $endDate = Carbon::parse($project->end_date)->format('Y-m');
                        return "{$startDate} to {$endDate}";
                    }),
                TextColumn::make('creator.firstname')
                ->label('Project Creator'),
                TextColumn::make('users.firstname')
                    ->label('Assigned Users')
                    ->badge()
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
            ])
            ->modifyQueryUsing(function (Builder $query) {
                /** @var \App\Models\User */
                $user = Auth::user();

                //if not admin, display only projects that is user is member of
                if (!$user->hasRole(['admin'])) {
                    $query->whereHas('users', function (Builder $query) use ($user) {
                        $query->where('users.id', $user->id);
                    });
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
