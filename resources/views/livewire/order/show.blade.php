<div>
    @if($order)
    <flux:modal name="show-order" class="min-w-[64rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Detail Pesanan</flux:heading>
                <flux:subheading>
                    <p>Nomor Pesanan: {{ $order->order_number }}</p>
                    <p>Tanggal: {{ $order->order_date }}</p>
                </flux:subheading>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <flux:text class="font-semibold">Bagian</flux:text>
                        <flux:text>{{ $order->user->division->name ?? 'Tidak Ada' }}</flux:text>
                    </div>
                    <div>
                        <flux:text class="font-semibold">Vendor</flux:text>
                        <flux:text>{{ $order->vendor->name ?? 'Tidak Ada' }}</flux:text>
                    </div>
                </div>

                <div>
                    <flux:text class="font-semibold mb-2">Daftar Barang</flux:text>
                    <div class="border rounded-lg overflow-hidden">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-4 py-2">Nama Barang</th>
                                    <th class="px-4 py-2">Ukuran/Tipe/Merek</th>
                                    <th class="px-4 py-2">Satuan</th>
                                    <th class="px-4 py-2">Jumlah</th>
                                    <th class="px-4 py-2">Harga</th>
                                    <th class="px-4 py-2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->items as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $item->name }}</td>
                                    <td class="px-4 py-2">{{ $item->description }}</td>
                                    <td class="px-4 py-2">{{ $item->unit }}</td>
                                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2">Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2">Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center">Tidak ada barang</td>
                                </tr>
                                @endforelse
                            </tbody>
                            <tfoot class="bg-gray-50 dark:bg-gray-700 font-bold">
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-right">Grand Total</td>
                                    <td class="px-4 py-2">Rp. {{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <flux:text class="font-semibold">Status</flux:text>
                    <flux:badge color="{{ $order->status === 'approved' ? 'emerald' : ($order->status === 'rejected' ? 'red' : 'yellow') }}">
                        {{ $order->status === 'approved' ? 'Disetujui' : ($order->status === 'rejected' ? 'Ditolak' : 'Menunggu') }}
                    </flux:badge>
                </div>

                @if($order->rejection_note)
                <div>
                    <flux:text class="font-semibold">Catatan Penolakan</flux:text>
                    <flux:text class="text-red-500">{{ $order->rejection_note }}</flux:text>
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