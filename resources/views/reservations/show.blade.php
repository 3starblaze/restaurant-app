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
    <p class="ml-5 max-w-xl">Rezervācijas sākums: {{ $reservation->starttime }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Rezervācijas beigas: {{ $reservation->endtime }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Viesu skaits: {{ $reservation->personcount }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Galdiņa nr: {{ $reservation->tablenum }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Vārds, uz kuru rezervē: {{ $reservation->reserver }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Piezīmes: {{ $reservation->description }}</p>
    <hr>
    <p class="ml-5 max-w-xl">Restorāns: {{ $restaurant->name }}</p>
</x-guest-layout>
