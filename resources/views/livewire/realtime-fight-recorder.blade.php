<div>
    <div class="block">
        <x-filament::button wire:click="startFight" :disabled="!$this->matchStatus" color="success">Test Start</x-filament::button>
        <x-filament::button wire:click="stopFight">Test Stop</x-filament::button>

    </div>
    <div class="grid grid-rows-3 grid-flow-col gap-4">
        <div class="row-span-3 ...">01</div>
        <div class="col-span-2 ...">02</div>
        <div class="row-span-2 col-span-2 ...">03</div>
    </div>
    <div class="grid grid-cols-4 gap-4">
        <x-filament::section class="col-span-3">
            <x-slot name="heading">
                Score Card
            </x-slot>

            {{-- Content --}}
        </x-filament::section>
        <x-filament::section class="col-span-1">
            <x-slot name="heading">
                Score Card
            </x-slot>

            <livewire:fight-score-history :fight="$this->fight"/>
        </x-filament::section>
    </div>
</div>
