@props([
    'logo',
    'alt'   => 'Employer Logo'
])
<img
    src="{{ Vite::asset("public/storage/$logo") }}"
    alt="{{ $alt }}"
    class="aspect-square object-cover object-center rounded-lg {{ $attributes->get('class') }}"
/>
