<x-guest-layout>
    <h1 class="text-3xl m-3">Reservations</h1>
    <a href="{{ route('restaurant.index') }}"
       class="text-gray-400">Back to restaurants
    </a>
    @forelse ($reservations as $reservation)
        <div class="ml-5 mt-5 max-w-xl">
            <h2 class="font-bold text-blue-800">
                <a href="{{ route('reservations.show', compact('reservation')) }}">
                    Reservation: {{ $reservation->id }}
                </a>
            </h2>
            <p>Start time: {{ $reservation->start_time }}</p>
            <p>End time: {{ $reservation->end_time }}</p>
            <p>Guests count: {{ $reservation->person_count }}</p>
            <p>Table: {{ $reservation->table_num }}</p>
            <p>Reserver name: {{ $reservation->reserver }}</p>
            <p style="font-weight: bold">Phone: {{ $reservation->phone_number }}</p>
        </div>
    @empty
        <p>No reservations yet.</p>
    @endforelse
</x-guest-layout>
