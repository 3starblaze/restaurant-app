<x-bare-layout>
    <div class="grid min-h-screen bg-gray-200"
         style="grid-template-columns: 10rem 1fr; grid-template-rows: 4rem 1fr">
        {{-- Menu --}}
        <div class="h-full w-full flex items-center justify-start bg-primary-800">
            <a href="{{ route('restaurant.index') }}">
                <x-bare.application-logo class="h-10 w-20 text-gray-100 fill-current" />
            </a>
        </div>
        <div class="h-full w-full p-2 flex items-center bg-primary-800">
            <div class="text-lg font-bold text-gray-100">
                Restaurant {{ Auth::user()->restaurant->name }}
            </div>
        </div>
        <div class="w-40 bg-white border-r-2 border-gray-200">
            <ul class="mt-5">
                <li class="pl-2 font-bold text-gray-900 flex gap-2">
                    <div class="h-6 w-6 border-2 border-blue-800 rounded-md"></div>
                    <div>
                        {{ __('Dashboard') }}
                    </div>
                </li>

                <div class="bg-gray-200 w-full h-0.5 my-5"></div>

                <x-dashboard.nav-link :href="route('dashboard.bookings')"
                                      icon-component="bare.outline.user-add">
                    {{ __('Bookings') }}
                </x-dashboard.nav-link>
                <x-dashboard.nav-link :href="route('dashboard.reservations')"
                                      icon-component="bare.outline.clipboard-list">
                    {{ __('Reservations') }}
                </x-dashboard.nav-link>
                <x-dashboard.nav-link href="#"
                                      icon-component="bare.outline.credit-card">
                    {{ __('Billing') }}
                </x-dashboard.nav-link>
                <x-dashboard.nav-link :href="route('dashboard.settings')"
                                      icon-component="bare.outline.cog">
                    {{ __('Settings') }}
                </x-dashboard.nav-link>
                <div class="bg-gray-200 w-full h-0.5 my-5"></div>
                <x-dashboard.nav-link href="#"
                                      icon-component="bare.outline.question-mark-circle">
                    {{ __('Support') }}
                </x-dashboard.nav-link>
            </ul>
        </div>
        <div class="bg-gray-100 p-2">
            {{ $slot }}
        </div>
    </div>
</x-bare-layout>
