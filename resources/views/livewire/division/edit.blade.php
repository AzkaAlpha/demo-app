<div>
    <flux:modal name="edit-division" class="w-full ">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Manajemen Divisi</flux:heading>
                <flux:text class="mt-2">Edit Divisi</flux:text>
            </div>
            <div class="flex flex-col gap-4">
                <flux:input label="Divisi" placeholder="Divisi" wire:model="name" />
            </div>
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="update" class="space-y-6">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>