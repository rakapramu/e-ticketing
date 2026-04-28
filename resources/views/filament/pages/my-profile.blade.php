<x-filament-panels::page>
    <form wire:submit.prevent="save">
        {{-- Di v5, $this->form tetap bisa dirender langsung jika menggunakan InteractsWithForms --}}
        {{ $this->form }}

        <div class="flex justify-center mt-8">
            <x-filament::button type="submit" size="xl" class="rounded-full px-12 shadow-lg">
                Update My Profile
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
