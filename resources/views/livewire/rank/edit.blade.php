<div>
<flux:modal name="edit-rank" class="!w-[50vw] !max-w-[50vw] !h-[50vh] !max-h-[50vh]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Manajemen Golongan</flux:heading>
            <flux:text class="mt-2">Edit Golongan.</flux:text>
        </div>
        <div class="flex flex-col gap-4">
            <flux:input label="Golongan" placeholder="Golongan" wire:model="name" />
            <flux:input label="Pangkat" placeholder="Pangkat " wire:model="description" />
        </div>
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary" wire:click="update">Update changes</flux:button>
        </div>
    </div>
</flux:modal>
</div>