<div class="space-y-3 mb-3">
    <flux:modal.trigger name="create-division">
        <flux:button variant="filled">
            {{ __('+ Tambah Divisi') }}
        </flux:button>
    </flux:modal.trigger>

<flux:modal name="create-division" class="w-full ">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Manajemen Divisi</flux:heading>
            <flux:text class="mt-2">Buat Divisi</flux:text>
        </div>
        <div class="flex flex-col gap-4">
            <flux:input label="Divisi" placeholder="Divisi" wire:model="name" />
        </div>
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary" wire:click="save" class="space-y-6">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
</div>
