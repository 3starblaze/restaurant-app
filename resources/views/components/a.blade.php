<a :href="$href"
   {{ $attributes->merge(['class' => implode(' ', [
       'inline-block', // To trim extra whitespace around the link
       'text-blue-900',
       'hover:text-blue-500',
      ])]) }}>
    {{ $slot }}
</a>
