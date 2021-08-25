<li class="my-3 pl-2">
    <x-a :href="$href" class="flex gap-2 items-center">
        <x-dynamic-component :component="$iconComponent" class="h-6 w-6" />
        <div>
            {{ $slot }}
        </div>
    </x-a>
</li>
