<a :href="$href"
   {{ $attributes->merge(['class' => implode(' ', [
       'text-gray-800',
       'underline',
       'hover:text-primary-500',
      ])]) }}>
    {{ $slot }}
</a>
