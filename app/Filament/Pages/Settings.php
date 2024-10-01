<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;


class Settings extends Page
{
    protected static ?string $navigationLabel = 'Settings';
    protected static ?string $slug = 'settings';
    protected static ?string $title = 'Settings';
    protected static string $view = 'filament.pages.settings';
    protected static ?string $navigationIcon = 'bi-gear-fill';
    protected static ?string $navigationGroup = 'Experiment Manager';
    protected static ?int $navigationSort = 5;

    public $group;

    // Initialize group settings
    public function mount()
    {
        // Fetch the group associated with the logged-in user
        $this->group = Auth::user()->group;

    
    }

    // Define the form schema
    protected function getFormSchema(): array
    {
        return [
            TextInput::make('group_name')
                ->label('Group Name')
                ->required()
                ->placeholder($this->group->group_name)
                ->default($this->group->group_name),

            TextInput::make('address')
                ->label('Address')
                ->required()
                ->placeholder($this->group->address)
                ->default($this->group->address),

            TextInput::make('faculty')
                ->label('Faculty')
                ->required()
                ->placeholder($this->group->faculty)
                ->default($this->group->faculty),

            TextInput::make('department')
                ->label('Department')
                ->placeholder($this->group->department)
                ->default($this->group->department),
        ];
    }

    // Save the settings back to the database
    public function submit()
    {
        // Validate the input fields
        $this->validate();

        // Update the group's settings in the database
        $this->group->update([
            'group_name' => $this->form->getState()['group_name'],
            'address' => $this->form->getState()['address'],
            'faculty' => $this->form->getState()['faculty'],
            'department' => $this->form->getState()['department'],
        ]);

        // Notify the user of a successful update
        $this->notify('success', 'Settings updated successfully!');
    }

    // Display the form
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema($this->getFormSchema())
            ])
            ->model($this->group)  // Bind the form to the group model
            ->statePath('data');   // Use a state path to bind form data
    }
}
