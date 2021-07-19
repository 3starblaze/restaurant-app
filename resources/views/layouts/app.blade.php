<x-bare-layout class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $header }}
                </h2>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 bg-white border-b border-gray-200">
                            @if (session('status'))
                                <div x-data="{ open: true }"
                                     x-show="open"
                                     class="bg-yellow-100 rounded-md flex mb-3 p-3">
                                    <div class="flex-1 m-1">
                                        {{ session('status') }}
                                    </div>
                                    <x-close-button @click="open = false">
                                        X
                                    </x-close-button>
                                </div>
                            @endif
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-bare-layout>
