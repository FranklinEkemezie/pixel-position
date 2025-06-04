@php
$activeClass = url()->current() === url($href) ? 'bg-white/10 rounded' : 'opacity-80 hover:opacity-90';
@endphp
<a
    {{ $attributes->merge([
        'class' => "px-4 py-1 font-bold hover:bg-white/20 hover:rounded $activeClass"
    ]) }}
>
    {{ $slot }}
</a>
