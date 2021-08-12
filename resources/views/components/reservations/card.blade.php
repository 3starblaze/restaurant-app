<div {{ $attributes->merge(['class' => 'max-w-xl']) }}>
    <x-h2>
        <x-a href="{{ route('bookings.create', compact('reservation')) }}">
            {{ $reservation->start_time }}
        </x-a>
        ({{ $reservation->duration }})
    </x-h2>
    <div class="flex items-center">
        <x-bare.user-icon class="text-primary-500 h-5 inline" />
        <p class="inline">{{ $reservation->max_person_count }}</p>
    </div>
    <p>{{ __('Description') }}: {{ $reservation->description }}</p>
</div>
