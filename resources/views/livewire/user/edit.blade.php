<div class="space-y-3 mb-3">
    
    <flux:modal name="edit-user" class="!w-[80vw] !max-w-[80vw] !h-[80vh] !max-h-[80vh]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Edit Pengguna</flux:heading>
            <flux:text class="mt-2">Kelola Data Pengguna.</flux:text>
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

               
                <div class="flex items-center">
                    <img src="{{ asset('/storage/' . $avatar) }}" alt="Avatar" class="w-24 h-24 rounded-full object-cover  mr-4">
                    <flux:input type="file" wire:model="newAvatar" label="Ganti Foto"/>
                </div>
        
        </div>
        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary" wire:click="update">Update User</flux:button>
        </div>
    </div>
</flux:modal>
</div>
