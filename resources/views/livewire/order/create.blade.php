<div x-data="{
    calculateTotal(key) {
        const quantity = parseFloat(this.$wire.get(`inputs.${key}.quantity`)) || 0;
        const price = parseFloat(this.$wire.get(`inputs.${key}.price`)) || 0;
        const total = quantity * price;
        this.$wire.set(`inputs.${key}.total`, total);
    }
}">
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-6">
        <flux:fieldset>
            <flux:legend>Order Barang</flux:legend>
            <div class="space-y-6 ">
                <div class="grid md:grid-cols-2 gap-x-4 gap-y-6">
                <flux:input label="Nomor Pesanan" placeholder="Auto-generated" wire:model="order_number" readonly />
                    <flux:input label="Tanggal Order" placeholder="Tanggal Order" type="date" wire:model="order_date" />
                    <flux:select label="Vendor" wire:model="vendor_id">
                        <flux:select.option value="">Pilih Vendor</flux:select.option>
                        @foreach ($vendors as $vendor)
                        <flux:select.option value="{{ $vendor->id }}">{{ $vendor->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
            </div>
        </flux:fieldset>
    </div>
    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-6 mt-5">
        <flux:fieldset>
            <flux:legend>List Barang</flux:legend>
            @foreach ($inputs as $key => $input)
                <div class="flex md:flex-row flex-col gap-4 mb-4 items-end w-full border-b border-gray-700 pb-4">
                    <flux:input  placeholder="Nama Barang" wire:model="inputs.{{ $key }}.item_name"  />
                    
                    <flux:input placeholder="Ukuran/Tipe/Merek" wire:model="inputs.{{ $key }}.description" />
                   
                    <flux:input  placeholder="Satuan" wire:model="inputs.{{ $key }}.unit" />
                   
                    <flux:input placeholder="Jumlah" type="number" min="1" step="1" wire:model="inputs.{{ $key }}.quantity" x-on:input="calculateTotal({{ $key }})" />

                    <flux:input placeholder="Harga" type="number" min="0" step="1" wire:model="inputs.{{ $key }}.price" x-on:input="calculateTotal({{ $key }})" />
                    
                    <flux:input placeholder="Total" wire:model="inputs.{{ $key }}.total" x-ref="total-{{ $key }}" readonly />
                    
                   <div class="flex gap-2">
                       <flux:button type="button" wire:click="addItem({{ $key }})" class="max-w-10"><flux:icon.plus class="size-4 mx-auto cursor-pointer" /></flux:button>
                       <flux:button type="button" variant="danger" wire:click="removeItem({{ $key }})" class="max-w-10 cursor-pointer" wire:confirm="Are you sure you want to delete this item?"><flux:icon.trash class="size-4 mx-auto" /></flux:button>
                   </div>
                </div>
            @endforeach
            <flux:button type="button" variant="filled" wire:click="save" class=" cursor-pointer" >Simpan</flux:button>
        </flux:fieldset>
    </div>
</div>