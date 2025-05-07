<div class="space-y-3 mb-3">
    <flux:modal.trigger name="create-rank">
        <flux:button variant="filled">
            {{ __('+ Tambah Golongan') }}
        </flux:button>
    </flux:modal.trigger>

<flux:modal name="create-rank" class="w-full">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Manajemen Golongan</flux:heading>
            <flux:text class="mt-2">Buat Golongan.</flux:text>
        </div>
        <div class="flex flex-col gap-4">
            <flux:input label="Golongan" placeholder="Golongan" wire:model="name" />
            <flux:input label="Pangkat" placeholder="Pangkat " wire:model="description" />
        </div>
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary" wire:click="save">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
</div>
