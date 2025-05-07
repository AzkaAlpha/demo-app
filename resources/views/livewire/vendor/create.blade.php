<div class="space-y-3 mb-3">
    <flux:modal.trigger name="create-vendor">
        <flux:button variant="filled">
            {{ __('+ Tambah Pengguna') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-vendor" class="!w-[80vw] !max-w-[80vw] !h-[80vh] !max-h-[80vh]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Manajemen Pengguna</flux:heading>
            <flux:text class="mt-2">Buat pengguna baru.</flux:text>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <flux:input label="Nama" placeholder="Nama Pengguna" wire:model="name" />
            <flux:input label="Email Vendor" placeholder="Email Vendor" type="email" wire:model="email" />
            <flux:input label="Alamat" placeholder="Alamat Vendor" wire:model="address" />
            <flux:input label="Telepon" placeholder="Telepon Vendor" wire:model="phone" />
            <flux:input label="Kontak Person" placeholder="Kontak Person" wire:model="contact_person" />
            <flux:input label="Kota" placeholder="Kota" wire:model="city" />
           
        </div>
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary" wire:click="save">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
</div>
