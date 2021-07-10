<textarea {{ $attributes->merge(['class' =>
             'rounded-md border-gray-300 border-2 focus:ring-2 focus:ring-blue-300']) }}>
    {{ $slot }}
</textarea>
