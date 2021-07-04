<x-app-layout>
    <x-slot name="header">{{  __('Business') }}</x-slot>
    <a href="{{ route('restaurant.create') }}">
        {{ __('Register now') }}!
    </a>
</x-app-layout>
