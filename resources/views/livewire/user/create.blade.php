<div class="space-y-3 mb-3">
    <flux:modal.trigger name="create-user">
        <flux:button variant="filled">
            {{ __('+ Tambah Pengguna') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-user" class="!w-[80vw] !max-w-[80vw] !h-[80vh] !max-h-[80vh]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Manajemen Pengguna</flux:heading>
            <flux:text class="mt-2">Buat pengguna baru.</flux:text>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <flux:input label="Nama" placeholder="Nama Pengguna" wire:model="name" />
            <flux:input label="Nip" placeholder="Nip" type="text" wire:model="nip"/>
            <flux:input label="Password" placeholder="Password" type="password" wire:model="password" />
            <flux:input label="Email" placeholder="Email" type="email" wire:model="email" />

            <flux:select wire:model="rank_id" label="Golongan" placeholder="Golongan">
                @foreach ($rank as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model="position_id" label="Jabatan" placeholder="Jabatan">
                @foreach ($position as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model="division_id" label="Bagian" placeholder="Bagian">
                @foreach ($division as $item)
                    <flux:select.option value="{{ $item->id }}">{{ $item->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:select wire:model="has_authority" label="Penandatangan" placeholder="Penandatangan">
                <flux:select.option  value="0" >Tidak</flux:select.option>
                <flux:select.option value="1">Ya</flux:select.option>
            </flux:select>

            <flux:select wire:model="role" label="Role" placeholder="Role">
                <flux:select.option value="user">User</flux:select.option>
                <flux:select.option  value="admin" >Admin</flux:select.option>
                <flux:select.option  value="guest" >Tamu</flux:select.option>
                <flux:select.option  value="super-user">Manajemen</flux:select.option>
            </flux:select>

            <flux:input type="file" wire:model="avatar" label="Upload Foto"/>
           

        </div>
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary" wire:click="save">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
</div>
