<x-guest-layout>
    <h1 class="text-3xl m-3 inline-block">Reservation: {{ $reservation->id }}</h1>
    <a href="{{ route('reservations.edit', compact('reservation')) }}"
       class="text-gray-400">
        (Edit)
    </a>
    <a href="{{ route('reservations.destroy', compact('reservation', 'restaurant')) }}"
       class="text-gray-400">
        (Delete)
    </a>
    <a class="text-blue-800" href="{{ route('reservations.index') }}">Back to list</a>
    <hr>
    <p class="ml-5 max-w-xl">Start: {{ $reservation->start_time }}</p>
    <hr>
    <p class="ml-5 max-w-xl">End: {{ $reservation->end_time }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Guests count: {{ $reservation->person_count }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Table: {{ $reservation->table_num }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Reserver name: {{ $reservation->reserver }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Notes: {{ $reservation->description }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Restaurant: {{ $restaurant->name }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Phone: {{ $reservation->phone_number }}</p>
</x-guest-layout>
