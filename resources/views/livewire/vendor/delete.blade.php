<div>
    <flux:modal name="delete-vendor" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Menghapus Vendor?</flux:heading>
    
                <flux:subheading>
                    <p>Apakah Anda yakin ingin menghapus Vendor ini</p>
                    <p>Anda tidak dapat mengembalikan Vendor ini.</p>
                </flux:subheading>
            </div>
    
            <div class="flex gap-2">
                <flux:spacer />
    
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
    
                <flux:button type="submit" variant="danger" @click="$wire.destroy">Delete Vendor</flux:button>
            </div>
        </div>
    </flux:modal>
    </div>
    