<div>
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-6">
        <flux:fieldset>
            <flux:legend>Permintaan Barang</flux:legend>
            <div class="space-y-6 ">
                <div class="grid md:grid-cols-2 gap-x-4 gap-y-6">
                    <flux:input label="Nomor Permintaan" placeholder="Auto-generated" wire:model="demand_number" readonly />
                    <flux:input label="Tanggal Permintaan" placeholder="Tanggal Permintaan" type="date" wire:model="demand_date" />
                    <flux:input label="Perihal" placeholder="Perihal Permintaan" wire:model="regarding" />
                </div>
            </div>
        </flux:fieldset>
    </div>
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-6 mt-5">
        <flux:fieldset>
            <flux:legend>List Barang</flux:legend>
            @foreach ($inputs as $key => $input)
                <div class="flex md:flex-row flex-col gap-4 mb-4 items-end w-full border-b border-gray-700 pb-4">
                    <flux:input placeholder="Nama Barang" wire:model="inputs.{{ $key }}.item_name" />
                    
                    <flux:input placeholder="Spesifikasi" wire:model="inputs.{{ $key }}.description" />
                   
                    <flux:input placeholder="Satuan" wire:model="inputs.{{ $key }}.unit" />
                   
                    <flux:input placeholder="Jumlah" wire:model="inputs.{{ $key }}.quantity" />
                    
                   <div class="flex gap-2">
                       <flux:button type="button" wire:click="addItem({{ $key }})" class="max-w-10"><flux:icon.plus class="size-4 mx-auto cursor-pointer" /></flux:button>
                       <flux:button type="button" variant="danger" wire:click="removeItem({{ $key }})" class="max-w-10 cursor-pointer" wire:confirm="Are you sure you want to delete this item?"><flux:icon.trash class="size-4 mx-auto" /></flux:button>
                   </div>
                </div>
            @endforeach
            <flux:button type="button" variant="filled" wire:click="save" class="cursor-pointer">Simpan</flux:button>
        </flux:fieldset>
    </div>
</div>
{{-- The best athlete wants his opponent at his best. --}}
</div>
