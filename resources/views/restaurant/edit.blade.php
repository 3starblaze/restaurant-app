<x-app-layout>
    <x-slot name="header">{{ __('Edit restaurant') }}</x-slot>
    <form method="POST" class="m-5"
          action="{{ route('restaurant.update', compact('restaurant')) }}">
        @csrf
        @method('PUT')
        <x-label name="name">Name</x-label>
        <x-input name="name" value="{{ $restaurant->name }}"></x-input>
        <x-label name="description">Description</x-label>
        <textarea name="description" class="block">
            {{  $restaurant->description }}
        </textarea>
        <x-button class="mt-5">Submit</x-button>
    </form>
</x-app-layout>
