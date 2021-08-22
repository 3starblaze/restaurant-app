<x-card {{ $attributes->merge(['class' => 'flex justify-between']) }}>
    <div>
        <p class="text-lg font-semibold">
                {{ $reservation->start_time->format('H:i') }}
                -
                {{ $reservation->end_time->format('H:i') }}
        </p>
        <div class="flex items-center">
            <x-bare.user-icon class="text-primary-500 h-5 inline" />
            <p class="inline">{{ $reservation->max_person_count }}</p>
        </div>
    </div>
    <x-arrow-button :href="route('bookings.create', compact('reservation'))"
                    :text="__('Book')"/>
</x-card>
