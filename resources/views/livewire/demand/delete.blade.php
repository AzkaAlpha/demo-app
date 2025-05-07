<div>
    <flux:modal name="delete-demand">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Hapus Permintaan</flux:heading>
                <flux:subheading>
                    <p>Apakah Anda yakin ingin menghapus permintaan ini?</p>
                    <p class="text-red-500">Tindakan ini tidak dapat dibatalkan.</p>
                </flux:subheading>
            </div>
            <div class="flex gap-2 justify-end">
                <flux:modal.close>
                    <flux:button variant="ghost">Batal</flux:button>
                </flux:modal.close>
                <flux:button wire:click="destroy" variant="danger">Hapus</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
