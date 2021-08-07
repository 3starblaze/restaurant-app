<div {{ $attributes->merge(['class' => 'max-w-xl']) }}>
    <x-h2>
        <x-a href="{{ route('reservations.show', compact('reservation')) }}">
    {{ $reservation->start_time }} - {{ $reservation->end_time }}
        </x-a>
    </x-h2>
    <p>{{ __('Guest count') }}: {{ $reservation->max_person_count }}</p>
    <p>{{ __('Description') }}: {{ $reservation->description }}</p>
</div>
