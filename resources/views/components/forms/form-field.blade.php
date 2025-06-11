@props(['name', 'label', 'placeholder' => '', 'type' => 'text', 'options'])

@php
    $formFieldClasses = "inline-block w-full max-w-3xl border border-gray-100/10 rounded-lg p-4 bg-white/10
        outline-none focus:border-transparent focus:ring-2 focus:ring-brand-blue";

@endphp

<div class="space-y-2">
    {{-- Form Field Label --}}
    <x-forms-form-label for="{{ $name }}">{{ $label }}</x-forms-form-label>

    {{-- Form field input --}}
    @if($type === 'select')
        {{-- 'select' input type --}}
        <select
            name="{{ $name }}" id="{{ $name }}"
            {{ $attributes(['class' => $formFieldClasses, 'autocomplete' => 'off']) }}
        >
            @foreach($options as $option)
                <option value="{{ $option }}" class="bg-brand-black text-white py-2">{{ $option }}</option>
            @endforeach
        </select>
    @elseif($type === 'checkbox')
        {{-- 'checkbox' input type --}}
        <div class="flex items-center space-x-2 {{ $formFieldClasses }}">
            <input type="checkbox" name="{{ $name }}" id="{{ $name }}"
               class="accent-brand-blue w-4 h-4"
                {{ $attributes }}
            />
            <label for="{{ $name }}">{{ $checkboxLabel ?? $label }}</label>
        </div
    @else
        {{--Default 'text' type --}}
        <x-forms.form-input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" />
    @endif

</div>

