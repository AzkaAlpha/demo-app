
<div>
    <section class="mt-10">
        <div class="mx-auto  px-2 lg:px-2">
            {{-- <flux:button variant="filled" class="mb-4 cursor-pointer" >+ Tambah</flux:button> --}}
    
            <livewire:vendor.create />
            <livewire:vendor.delete />

            <livewire:vendor.edit />

            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
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
                            <label class="w-40 text-sm font-medium text-gray-900 dark:text-gray-400">User Type :</label>
                            <select wire:model.live.debounce.250ms="user_type"
                                class="bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">All</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="guest">Tamu</option>
                                <option value="super-user">Manajemen</option>

                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3">no</th>
                                    <th scope="col" class="px-4 py-3">vendor</th>
                                    <th scope="col" class="px-4 py-3">alamat</th>
                                    <th scope="col" class="px-4 py-3">email</th>
                                    <th scope="col" class="px-4 py-3">pic</th>
                                    <th scope="col" class="px-4 py-3">telpon</th>
                                    <th scope="col" class="px-4 py-3">kota</th>
                                    <th scope="col" class="px-4 py-3">status</th>
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
                                    {{$item->name}}</th>
                                <td class="px-4 py-3">{{ $item->address }}</td>
                                <td class="px-4 py-3">{{ $item->email }}</td>
                                <td class="px-4 py-3">{{ $item->contact_person }}</td>
                                <td class="px-4 py-3">{{ $item->phone }}</td>
                                <td class="px-4 py-3">{{ $item->city }}</td>
                                <td class="px-4 py-3 text-green-500">
                                    <flux:badge color="emerald">{{ $item->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}</flux:badge></td>
                                <td class="px-4 py-3 flex items-center justify-end gap-2">
                                    <button class="px-3 py-1 bg-yellow-500 text-white rounded cursor-pointer" wire:click="edit({{$item->id}})"><flux:icon.pencil-square class="size-4" /></button>
                                    <button class="px-3 py-1 bg-red-500 text-white rounded cursor-pointer" wire:click="delete({{$item->id}})"><flux:icon.trash class="size-4" /></button>
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
    


