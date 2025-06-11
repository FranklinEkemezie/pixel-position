@php
$activeClass = url()->current() === url($href ?? '') ? 'bg-white/10 rounded' : 'opacity-80 hover:opacity-90';
$defaultBtnClass = "px-4 py-1 font-bold hover:bg-white/20 hover:rounded cursor-pointer $activeClass";
@endphp

@if($attributes->has('href'))
    <a {{ $attributes(['class' => $defaultBtnClass]) }}>
        {{ $slot }}
    </a>
@else
    <button
        type="{{ $type ?? 'submit' }}"
        {{ $attributes(['class' => $defaultBtnClass]) }}
    >
        {{ $slot }}
    </button>
@endif

