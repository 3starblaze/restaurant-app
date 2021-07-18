<a :href="$href"
   {{ $attributes->merge(['class' => implode(' ', [
       'text-gray-800',
       'underline',
       'inline-block', // To trim extra whitespace around the link
       'hover:text-primary-500',
      ])]) }}>
    {{ $slot }}
</a>
