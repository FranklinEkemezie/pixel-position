@props([
    'href'  => null,
    'type'  => 'submit',
    'class' => ''
])
@php
    $buttonDefaultClasses = "bg-brand-blue hover:bg-brand-blue/80 px-4 py-2 rounded font-bold border-none outline-0";
    $classes = "$buttonDefaultClasses $class";
@endphp
@if($href !== null)
    <a {{ $attributes }} href="{{ $href }}" class="{{ $classes }}">{{ $slot }}</a>
@else
    <button type="{{ $type }}" {{ $attributes }} class="{{ $classes }}">{{ $slot }}</button>
@endif
