<h2 {{ $attributes->merge(['class' => implode(' ', [
       'mt-5',
       'mb-3',
       'font-bold',
       'text-lg',
       'text-gray-900',
       'leading-tight',
       ])]) }}>
    {{ $slot }}
</h2>
