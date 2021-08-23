<x-dashboard-layout>
    <h1 class="text-xl text-primary-500 font-bold">Your reservations</h1>

    <x-a href="#" class="mb-3">
        Create reservation
    </x-a>

    @foreach($groups as $date => $group)
        <x-text-divider>{{ $date }}</x-text-divider>

        <div class="grid grid-cols-4 gap-2 mb-5">
            @foreach($group as $reservation)
                <x-card class="p-2">
                    <p class="text-lg">
                        <span class="font-semibold">
                            {{ $reservation->start_time->format('H:i') }}
                            -
                            {{ $reservation->end_time->format('H:i') }}
                        </span>
                    </p>
                    <div class="flex items-center">
                        <x-bare.user-icon class="text-primary-500 h-5 inline" />
                        <p class="inline">{{ $reservation->max_person_count }}</p>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endforeach
</x-dashboard-layout>
