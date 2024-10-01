<x-filament-panels::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}
        <div class="mt-6"></div>
        <x-filament::button type="submit" class="mt-4">
            Save Settings
        </x-filament::button>
    </form>
</x-filament-panels::page>
