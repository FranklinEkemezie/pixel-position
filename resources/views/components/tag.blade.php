@props([
    'size'  => 'sm',
    'tag'
])

@php
    $textSizeClass = match ($size) {
        'xs'    => 'text-xs font-semibold',
        '2xs'   => 'text-2xs font-semibold',
        default => 'text-sm font-bold'
    };
@endphp
<a
    {{ $attributes->merge([
        'class' => "$textSizeClass inline-block space-y-2 capitalize bg-white/20 hover:bg-white/30
            px-4 py-1 rounded-2xl",
        'href'  => "/tags/" . strtolower($tag->name)
    ]) }}
>{{ strtolower($tag->name)  }}</a>
