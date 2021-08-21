<x-bare-layout>
    <div class="grid min-h-screen gap-0.5 p-0.5 bg-primary-200"
         style="grid-template-columns: 10rem 1fr; grid-template-rows: 4rem 1fr">
        {{-- Menu --}}
        <div class="h-full w-full flex items-center justify-start bg-white">
            <a href="{{ route('restaurant.index') }}">
                <x-application-logo class="h-10 w-20" />
            </a>
        </div>
        <div class="h-full w-full p-2 flex items-center bg-white">
            <div class="text-lg font-bold text-gray-800">
                Restaurant {{ Auth::user()->restaurant->name }}
            </div>
        </div>
        <div class="w-40 pl-2 bg-white">
            <ul>
                <li class="my-2">Bookings</li>
                <li class="my-2">Reservations</li>
                <li class="my-2">Billing</li>
                <li class="my-2">Settings</li>
                <li class="my-2 pt-2 border-t border-primary-200">Support</li>
            </ul>
        </div>
        <div class="bg-white p-2">
            {{ $slot }}
        </div>
    </div>
</x-bare-layout>
