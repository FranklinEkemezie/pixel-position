@php
    $activeClass = url()->current() === url($href) ? 'opacity-100 underline underline-offset-4' :
        'opacity-80 hover:opacity-90 hover:-translate-y-0.5';
@endphp
<a
    {{ $attributes->merge([
        'class' => "px-4 py-1 font-bold transition duration-200 $activeClass"
        ])
    }}
>
    {{ $slot }}
</a>

