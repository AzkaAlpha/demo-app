<div>
    <section class="mt-10">
        <div class="mx-auto px-2 lg:px-2">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Pesanan Barang</h1>
                <p class="text-gray-600 dark:text-gray-400">Kelola dan lacak semua pesanan Anda di satu tempat</p>
            </div>
            
            <flux:button variant="filled">
                <a wire:navigate href="{{ route('order.create') }}">{{ __('+ Tambah Pesanan') }}</a> 
            </flux:button>

            
           
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-visible">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input wire:model.live.debounce.250ms="search"  type="text"
                                class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search" >
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <label class="w-40 text-sm font-medium text-gray-900 dark:text-gray-400">Status :</label>
                            <select wire:model.live.debounce.250ms="status"
                                class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="process">Process</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">no</th>
                                    <th scope="col" class="px-4 py-3">nomor pesanan</th>
                                    <th scope="col" class="px-4 py-3">tanggal pesanan</th>
                                    <th scope="col" class="px-4 py-3">Bagian</th>
                                    <th scope="col" class="px-4 py-3">Vendor</th>
                                    <th scope="col" class="px-4 py-3">Nama Barang</th>
                                    <th scope="col" class="px-4 py-3">status</th>
                                    <th scope="col" class="px-4 py-3">Status Persetujuan</th>
                                    <th scope="col" class="px-4 py-3">Catatan</th>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as  $index => $item)
                            <tr class="border-b dark:border-gray-600">
                                <td class="px-4 py-3">{{ $data->firstItem() + $index }}</td>
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$item->order_number }}</th>
                                <td class="px-4 py-3">{{ \Carbon\Carbon::parse($item->order_date)->locale('id')->isoFormat('D MMMM Y') }}</td>
                                <td class="px-4 py-3">{{ $item->user->division->name }}</td>
                                <td class="px-4 py-3">{{ $item->vendor->name }}</td>
                                <td class="px-4 py-3">
                                    @foreach($item->items as $orderItem)
                                        {{ $orderItem->name }},
                                    @endforeach
                                </td>
                                <td class="px-4 py-3 text-green-500">
                                    <flux:badge :color="App\Models\Order::getStatusColor($item->status)">
                                        {{ App\Models\Order::getStatusLabel($item->status) }}
                                    </flux:badge>
                                </td>
                                <td class="px-4 py-3">
                                    @if( Auth::user()->position->id == 2 &&  $item->status == 'pending')
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-all duration-200 ease-in-out cursor-pointer shadow-sm hover:shadow-md">
                                            <flux:icon.clipboard-document-check class="size-5" />
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="absolute left-10 top-5 z-50 mb-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                                            <div class="py-1" role="menu" aria-orientation="vertical">
                                                <button wire:click="processedOrder({{ $item->id }})" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/20 flex items-center gap-2 cursor-pointer transition-all duration-200 ease-in-out hover:scale-[1.02] hover:shadow-sm">
                                                    <div class="p-1.5 bg-green-100 dark:bg-green-900/30 rounded-full">
                                                        <flux:icon.check-circle class="size-4 text-green-500" />
                                                    </div>
                                                    <span class="font-medium">Setujui</span>
                                                </button>
                                                <button wire:click="$dispatch('order.reject', { id: {{ $item->id }} })" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-red-50 dark:hover:bg-red-900/20 flex items-center gap-2 cursor-pointer transition-all duration-200 ease-in-out hover:scale-[1.02] hover:shadow-sm">
                                                    <div class="p-1.5 bg-red-100 dark:bg-red-900/30 rounded-full">
                                                        <flux:icon.x-circle class="size-4 text-red-500" />
                                                    </div>
                                                    <span class="font-medium">Tolak</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif( Auth::user()->position->id == 14 && Auth::user()->has_authority == 1 && $item->status == 'processed')
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-all duration-200 ease-in-out cursor-pointer shadow-sm hover:shadow-md">
                                            <flux:icon.clipboard-document-check class="size-5" />
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="absolute left-10 top-5 z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                                            <div class="py-1" role="menu" aria-orientation="vertical">
                                                <button wire:click="verifiedOrder({{ $item->id }})" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/20 flex items-center gap-2 cursor-pointer transition-all duration-200 ease-in-out hover:scale-[1.02] hover:shadow-sm">
                                                    <div class="p-1.5 bg-green-100 dark:bg-green-900/30 rounded-full">
                                                        <flux:icon.check-circle class="size-4 text-green-500" />
                                                    </div>
                                                    <span class="font-medium">Setujui</span>
                                                </button>
                                                <button wire:click="$dispatch('order.reject', { id: {{ $item->id }} })" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-red-50 dark:hover:bg-red-900/20 flex items-center gap-2 cursor-pointer transition-all duration-200 ease-in-out hover:scale-[1.02] hover:shadow-sm">
                                                    <div class="p-1.5 bg-red-100 dark:bg-red-900/30 rounded-full">
                                                        <flux:icon.x-circle class="size-4 text-red-500" />
                                                    </div>
                                                    <span class="font-medium">Tolak</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif( Auth::user()->position->id == 15 && Auth::user()->has_authority == 1 && $item->status == 'verified')
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-all duration-200 ease-in-out cursor-pointer shadow-sm hover:shadow-md">
                                            <flux:icon.clipboard-document-check class="size-5" />
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="absolute left-10 top-5 z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                                            <div class="py-1" role="menu" aria-orientation="vertical">
                                                <button wire:click="validatedOrder({{ $item->id }})" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/20 flex items-center gap-2 cursor-pointer transition-all duration-200 ease-in-out hover:scale-[1.02] hover:shadow-sm">
                                                    <div class="p-1.5 bg-green-100 dark:bg-green-900/30 rounded-full">
                                                        <flux:icon.check-circle class="size-4 text-green-500" />
                                                    </div>
                                                    <span class="font-medium">Setujui</span>
                                                </button>
                                                <button wire:click="$dispatch('order.reject', { id: {{ $item->id }} })" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-red-50 dark:hover:bg-red-900/20 flex items-center gap-2 cursor-pointer transition-all duration-200 ease-in-out hover:scale-[1.02] hover:shadow-sm">
                                                    <div class="p-1.5 bg-red-100 dark:bg-red-900/30 rounded-full">
                                                        <flux:icon.x-circle class="size-4 text-red-500" />
                                                    </div>
                                                    <span class="font-medium">Tolak</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif( Auth::user()->position->id == 1 && Auth::user()->has_authority == 1 && $item->status =='validated')
                                    <div class="relative" x-data="{ open: false }">
                                        <button @click="open = !open" class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-all duration-200 ease-in-out cursor-pointer shadow-sm hover:shadow-md">
                                            <flux:icon.clipboard-document-check class="size-5" />
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="absolute left-10 top-5 z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5">
                                            <div class="py-1" role="menu" aria-orientation="vertical">
                                                <button wire:click="approvedOrder({{ $item->id }})" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-green-50 dark:hover:bg-green-900/20 flex items-center gap-2 cursor-pointer transition-all duration-200 ease-in-out hover:scale-[1.02] hover:shadow-sm">
                                                    <div class="p-1.5 bg-green-100 dark:bg-green-900/30 rounded-full">
                                                        <flux:icon.check-circle class="size-4 text-green-500" />
                                                    </div>
                                                    <span class="font-medium">Setujui</span>
                                                </button>
                                                <button wire:click="$dispatch('order.reject', { id: {{ $item->id }} })" class="w-full text-left px-4 py-2.5 text-sm text-gray-700 dark:text-gray-200 hover:bg-red-50 dark:hover:bg-red-900/20 flex items-center gap-2 cursor-pointer transition-all duration-200 ease-in-out hover:scale-[1.02] hover:shadow-sm">
                                                    <div class="p-1.5 bg-red-100 dark:bg-red-900/30 rounded-full">
                                                        <flux:icon.x-circle class="size-4 text-red-500" />
                                                    </div>
                                                    <span class="font-medium">Tolak</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    @if($item->status == 'rejected')
                                    <div class="text-[7pt]">
                                        <p>{{ 'Ditolak oleh :'}}</p>
                                        <ul>
                                            <li>{{ $item->rejectedOrder->position->name ?? 'Unknown' }}</li>
                                        </ul>
                                    </div>
                                    @elseif($item->status == 'processed')
                                    <ul class="text-xs list-disc">
                                        <li class="font-xs">{{ 'Disetujui oleh :'}}</li>
                                        <li>{{ $item->processedOrder->position->name ?? 'Unknown' }}</li>    
                                    </ul>
                                    
                                    @elseif($item->status == 'verified')
                                    <div class="text-[7pt]">
                                        <p>{{ 'Disetujui oleh :'}}</p>
                                    <ul class="list-disc">
                                        <li> {{ $item->processedOrder->position->name ?? 'Unknown' }}</li>
                                        <li> {{ $item->verifiedOrder->position->name?? 'Unknown' }}</li>
                                    </ul>
                                    </div>
                                    
                                    @elseif($item->status == 'validated')
                                    <div class="text-[7pt]">
                                        <p>{{ 'Disetujui oleh :'}}</p>
                                    <ul class="list-disc">
                                        <li> {{ $item->processedOrder->position->name ?? 'Unknown' }}</li>
                                        <li> {{ $item->verifiedOrder->position->name?? 'Unknown' }}</li>
                                        <li> {{ $item->validatedOrder->position->name?? 'Unknown' }}</li>
                                    </ul>
                                    </div>
                                    @elseif($item->status == 'approved')
                                    <div class="text-[7pt]">
                                        <p>{{ 'Disetujui oleh :'}}</p>
                                    <ul class="list-disc">
                                        <li> {{ $item->processedOrder->position->name ?? 'Unknown' }}</li>
                                        <li> {{ $item->verifiedOrder->position->name?? 'Unknown' }}</li>
                                        <li> {{ $item->validatedOrder->position->name?? 'Unknown' }}</li>
                                        <li> {{ $item->approvedOrder->position->name?? 'Unknown' }}</li>
                                    </ul>
                                    </div>
                                    @else
                                    {{ 'Menunggu Persetujuan Bendahara'}}
                                    @endif

                                @endif
                                </td>
                               
                                <td class="px-4 py-3">
                                    {{ $item->status === 'rejected' ? $item->note : '' }}
                                </td>
                               
                                <td class="px-4 py-3 flex items-center justify-end gap-2">

                                    @if($item->status == 'approved')
                                    <button wire:click="generatePDF({{ $item->id }})" class="px-3 py-1 bg-amber-600 text-white rounded cursor-pointer">
                                        <flux:icon.document class="size-4" />
                                    </button>
                                    @endif
                                    <button wire:click="$dispatch('order.show', { id: {{ $item->id }} })" class="px-3 py-1 bg-blue-500 text-white rounded cursor-pointer">
                                        <flux:icon.eye class="size-4" />
                                    </button>
                                    <button class="px-3 py-1 bg-yellow-500 text-white rounded cursor-pointer" wire:navigate href="{{ route('order.edit', $item->id) }}"><flux:icon.pencil-square class="size-4" /></button>
                                    <button class="px-3 py-1 bg-red-500 text-white rounded cursor-pointer" wire:navigate href="{{ route('order.delete', $item->id) }}"><flux:icon.trash class="size-4" /></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3"> 
                    {{ $data->links() }}
                </div>
            </div>
    </section>
</div>
    
@livewire('order.reject')
@livewire('order.show')


