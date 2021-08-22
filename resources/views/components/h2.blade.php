<h2 {{ $attributes->merge(['class' => implode(' ', [
       'mt-5',
       'mb-3',
       'font-bold',
       'text-lg',
       'text-primary-500',
       'leading-tight',
       ])]) }}>
    {{ $slot }}
</h2>
