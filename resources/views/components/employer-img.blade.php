@props([
    'alt'   => 'Job Image',
    'size'  => 90,
    'src'
])
<img
    src="{{ Vite::asset($src) }}"
    alt="{{ $alt }}"
    class="w-{{ $size }} aspect-square object-cover object-center rounded-lg"
/>
