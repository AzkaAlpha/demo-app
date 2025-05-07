<div>
    @if($demand)
    <flux:modal name="show-demand" class="min-w-[52rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Detail Permintaan</flux:heading>
                <flux:subheading>
                    <p>Nomor Permintaan: {{ $demand->demand_number }}</p>
                    <p>Tanggal: {{ $demand->demand_date }}</p>
                </flux:subheading>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:text class="font-semibold">Bagian</flux:text>
                        <flux:text>{{ $demand->user->division->name ?? 'Tidak Ada' }}</flux:text>
                    </div>
                    <div>
                        <flux:text class="font-semibold">Perihal</flux:text>
                        <flux:text>{{ $demand->regarding ?? 'Tidak Ada' }}</flux:text>
                    </div>
                </div>

                <div>
                    <flux:text class="font-semibold mb-2">Daftar Barang</flux:text>
                    <div class="border rounded-lg overflow-hidden">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2">Nama Barang</th>
                                    <th class="px-4 py-2">Spesifikasi</th>
                                    <th class="px-4 py-2">Satuan</th>
                                    <th class="px-4 py-2">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($demand->demandItems as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $item->name }}</td>
                                    <td class="px-4 py-2">{{ $item->description }}</td>
                                    <td class="px-4 py-2">{{ $item->unit }}</td>
                                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center">Tidak ada barang</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <flux:text class="font-semibold">Status</flux:text>
                    <flux:badge color="{{ $demand->status === 'approved' ? 'emerald' : ($demand->status === 'rejected' ? 'red' : 'yellow') }}">
                        {{ $demand->status === 'approved' ? 'Disetujui' : ($demand->status === 'rejected' ? 'Ditolak' : 'Menunggu') }}
                    </flux:badge>
                </div>

                @if($demand->note)
                <div>
                    <flux:text class="font-semibold">Catatan</flux:text>
                    <flux:text class="text-red-500">{{ $demand->note }}</flux:text>
                </div>
                @endif
            </div>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Tutup</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
    @endif
</div>
{{-- Nothing in the world is as soft and yielding as water. --}}
</div>
