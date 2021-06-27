<x-guest-layout>
    <h1 class="text-3xl m-3">Reservations</h1>
    <a href="{{ route('restaurant.index') }}"
       class="text-gray-400">Back to restaurants
    </a>
    @forelse ($reservations as $reservation)
        <div class="ml-5 mt-5 max-w-xl">
            <h2 class="font-bold text-blue-800">
                <a href="{{ route('reservations.show', compact('reservation')) }}">
                    Rezervācijas nr. {{ $reservation->id }}
                </a>
            </h2>
            <p>Sākums: {{ $reservation->starttime }}</p>
            <p>Beigas: {{ $reservation->endtime }}</p>
            <p>Cilvēku skaits: {{ $reservation->personcount }}</p>
            <p>Galda nr: {{ $reservation->tablenum }}</p>
            <p>Rezervētāja vārds: {{ $reservation->reserver }}</p>
        </div>
    @empty
        <p>No reservations yet.</p>
    @endforelse
</x-guest-layout>
