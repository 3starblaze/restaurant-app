<x-bare-layout class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            @if (session('status'))
                <div x-data="{ open: true }"
                     x-show="open"
                     class="app bg-yellow-100 rounded-md flex mb-3 p-3">
                    <div class="flex-1 m-1">
                        {{ session('status') }}
                    </div>
                    <x-close-button @click="open = false">
                        X
                    </x-close-button>
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>
</x-bare-layout>
