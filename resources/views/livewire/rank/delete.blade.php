<div>
    <flux:modal name="delete-rank" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Menghapus Golongan?</flux:heading>
    
                <flux:subheading>
                    <p>Apakah Anda yakin ingin menghapus golongan ini</p>
                    <p>Anda tidak dapat mengembalikan golongan ini.</p>
                </flux:subheading>
            </div>
    
            <div class="flex gap-2">
                <flux:spacer />
    
                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>
    
                <flux:button type="submit" variant="danger" @click="$wire.destroy">Delete layanan</flux:button>
            </div>
        </div>
    </flux:modal>
    </div>
    