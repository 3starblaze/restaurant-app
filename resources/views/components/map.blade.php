<x-map-utils.bare-map {{ $attributes }} />

<script type="text/javascript">
 (() => {
     <x-map-utils.map-setup {{ $attributes }} />
     {{ $slot }}
 })();
</script>
