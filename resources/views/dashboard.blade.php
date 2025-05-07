<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Statistics Cards -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900">
                        <flux:icon.shopping-cart class="h-6 w-6 text-indigo-600 dark:text-indigo-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pesanan</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalOrders }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-green-600 dark:text-green-400">
                            <flux:icon.arrow-up class="h-4 w-4" />
                            {{ $orderGrowth }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">from last month</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                        <flux:icon.clock class="h-6 w-6 text-yellow-600 dark:text-yellow-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pesanan Diproses</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $processOrders }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-yellow-600 dark:text-yellow-400">
                            {{ $processPercentage }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">of total orders</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                        <flux:icon.check-circle class="h-6 w-6 text-green-600 dark:text-green-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pesanan Disetujui</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $approvedOrders }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-green-600 dark:text-green-400">
                            {{ $approvedPercentage }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">approval rate</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 dark:bg-red-900">
                        <flux:icon.x-circle class="h-6 w-6 text-red-600 dark:text-red-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Pesanan Ditolak</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $rejectedOrders }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-red-600 dark:text-red-400">
                            {{ $rejectionRate }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">rejection rate</span>
                    </div>
                </div>
            </div>

            <!-- Demand Statistics Cards -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900">
                        <flux:icon.document-text class="h-6 w-6 text-blue-600 dark:text-blue-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Permintaan</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $totalDemands }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                            {{ $totalDemands > 0 ? round(($completedDemands / $totalDemands) * 100) : 0 }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">completion rate</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900">
                        <flux:icon.clock class="h-6 w-6 text-yellow-600 dark:text-yellow-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Permintaan Diproses</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $processedDemands }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-yellow-600 dark:text-yellow-400">
                            {{ $totalDemands > 0 ? round(($processedDemands / $totalDemands) * 100) : 0 }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">processing rate</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 dark:bg-green-900">
                        <flux:icon.check-circle class="h-6 w-6 text-green-600 dark:text-green-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Permintaan Disetujui</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $approvedDemands }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-green-600 dark:text-green-400">
                            {{ $totalDemands > 0 ? round(($approvedDemands / $totalDemands) * 100) : 0 }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">approval rate</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-100 dark:bg-red-900">
                        <flux:icon.x-circle class="h-6 w-6 text-red-600 dark:text-red-400" />
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Permintaan Ditolak</p>
                        <p class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $rejectedDemands }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="flex items-center">
                        <span class="text-sm font-medium text-red-600 dark:text-red-400">
                            {{ $totalDemands > 0 ? round(($rejectedDemands / $totalDemands) * 100) : 0 }}%
                        </span>
                        <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">rejection rate</span>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Orders/Demands and Statistics -->
        <div class="grid gap-4 md:grid-cols-2">
            <!-- Recent Demands -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Permintaan Terbaru</h3>
                    <div class="mt-4 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Permintaan Barang</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Status</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($recentDemands as $demand)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $demand->demand_number ?? 'DEM-' . $demand->id }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            <flux:badge :color="App\Models\Demand::getStatusColor($demand->status)">
                                                    {{ App\Models\Order::getStatusLabel($demand->status) }}
                                                </flux:badge>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $demand->created_at->format('d M Y') }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Pesanan Terbaru</h3>
                    <div class="mt-4 flow-root">
                        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                <table class="min-w-full divide-y divide-gray-300 dark:divide-gray-700">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Order</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Status</th>
                                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900 dark:text-gray-100">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($recentOrders as $order)
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                {{ $order->order_number }}
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                                <flux:badge :color="App\Models\Order::getStatusColor($order->status)">
                                                    {{ App\Models\Order::getStatusLabel($order->status) }}
                                                </flux:badge>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 dark:text-gray-400">
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Statistics -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Statistik Pesanan</h3>
                    <div class="mt-4">
                        <div class="space-y-4">
                            <!-- Status Distribution -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Distribusi Status</h4>
                                <div class="mt-2 grid grid-cols-2 gap-4">
                                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Approved</span>
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $approvedPercentage }}%</span>
                                        </div>
                                        <div class="mt-2 h-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full">
                                            <div class="h-2 bg-green-500 rounded-full" style="width: {{ $approvedPercentage }}%"></div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-500 dark:text-gray-400">Disetujui</span>
                                            <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $processPercentage }}%</span>
                                        </div>
                                        <div class="mt-2 h-2 w-full bg-gray-200 dark:bg-gray-700 rounded-full">
                                            <div class="h-2 bg-yellow-500 rounded-full" style="width: {{ $processPercentage }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Monthly Trend -->
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Tren Bulanan</h4>
                                <div class="mt-2 h-32">
                                    <div class="h-full flex items-end space-x-2">
                                        @foreach($monthlyOrders as $month)
                                        <div class="flex-1">
                                            <div class="bg-gradient-to-t from-indigo-500 to-indigo-400 dark:from-indigo-600 dark:to-indigo-500 rounded-t hover:opacity-90 transition-opacity duration-200" style="height: {{ $month->percentage }}%"></div>
                                            <div class="text-xs text-center text-gray-500 dark:text-gray-400 mt-1">{{ $month->month }}</div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
