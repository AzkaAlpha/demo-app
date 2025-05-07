<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased">
        <!-- Warehouse/ordering goods background -->
        <div class="absolute inset-0 z-0 bg-[url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center opacity-30 dark:opacity-15"></div>
        <div class="absolute inset-0 z-0 bg-gradient-to-br from-blue-50/70 via-white/80 to-blue-50/70 dark:from-blue-900/15 dark:via-blue-950/20 dark:to-blue-900/15"></div>

        <div class="flex min-h-svh flex-col items-center justify-center p-6 md:p-10 relative z-10">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center">
                    <a href="{{ route('home') }}" class="inline-flex flex-col items-center gap-3" wire:navigate>
                        <span class="flex h-16 w-16 items-center justify-center rounded-2xl bg-white/90 backdrop-blur-md shadow-lg transition-all duration-300 hover:bg-white dark:bg-blue-950/90 dark:hover:bg-blue-950">
                            <x-app-logo-icon class="size-12 fill-current text-blue-700 dark:text-blue-300" />
                        </span>
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                </div>

                <div class="overflow-hidden rounded-2xl border border-white/30 bg-white/90 backdrop-blur-lg shadow-xl transition-all duration-300 hover:shadow-2xl dark:border-blue-700/30 dark:bg-blue-950/90">
                    <div class="px-8 py-10 sm:px-10 sm:py-12">
                        <h2 class="text-center text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">
                            {{ __('Sistem Informasi Manajemen Barang Internal') }}
                        </h2>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
