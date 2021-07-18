<h2 {{ $attributes->merge(['class' => implode(' ', [
       'font-bold',
       'text-lg',
       'text-primary-500',
       'leading-tight',
       ])]) }}>
    {{ $slot }}
</h2>
