<div>
    <flux:modal name="edit-position" class="w-full">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Manajemen Jabatan</flux:heading>
                <flux:text class="mt-2">Edit Jabatan.</flux:text>
            </div>
            <div class="flex flex-col gap-4">
                <flux:input label="Jabatan" placeholder="Jabatan" wire:model="name" />
            </div>
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="update">Update changes</flux:button>
            </div>
        </div>
    </flux:modal>
    </div>