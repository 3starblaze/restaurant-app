<a :href="$href"
   {{ $attributes->merge(['class' => implode(' ', [
       'text-gray-500',
       'underline',
       'hover:text-primary-500',
      ])]) }}>
    {{ $slot }}
</a>
