<x-dashboard-layout>
    <h1 class="text-xl text-primary-500 font-bold">Your bookings</h1>
    <div class="grid grid-cols-3 gap-2">
        <div class="flex flex-col">
            <x-h2>Pending</x-h2>
            @foreach(Auth::user()->restaurant->bookings as $booking)
                <x-card class="p-2 mb-2 flex justify-between">
                    <div>
                        <p>{{ $booking->reservation->start_time->format('H:i') }}</p>
                        <p>{{ $booking->name }}</p>
                        <p>{{ $booking->phone_number }}</p>
                    </div>
                    <x-arrow-button href="#" text="Accept" />
                </x-card>
            @endforeach
        </div>
        <div class="flex flex-col">
            <x-h2>Accepted</x-h2>
            @foreach(Auth::user()->restaurant->bookings as $booking)
                <x-card class="p-2 mb-2 flex justify-between">
                    <div>
                        <p>{{ $booking->reservation->start_time->format('H:i') }}</p>
                        <p>{{ $booking->name }}</p>
                        <p>{{ $booking->phone_number }}</p>
                    </div>
                    <x-arrow-button href="#" text="Register Arrival" />
                </x-card>
            @endforeach
        </div>
        <div class="flex flex-col">
            <x-h2>Missed</x-h2>
            @foreach(Auth::user()->restaurant->bookings as $booking)
                <x-card class="p-2 mb-2">
                    <div>
                        <p>{{ $booking->reservation->start_time->format('H:i') }}</p>
                        <p>{{ $booking->name }}</p>
                        <p>{{ $booking->phone_number }}</p>
                    </div>
                </x-card>
            @endforeach
        </div>
    </div>
</x-dashboard-layout>
