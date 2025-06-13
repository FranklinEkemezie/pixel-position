@props([
    'name',
    'label',
    'placeholder'   => '',
    'value'         => null,
    'type'          => 'text',
    'options'
])

@php
    $formFieldClasses = "inline-block w-full max-w-3xl border border-gray-100/10 rounded-lg p-4 bg-white/10
        outline-none focus:border-transparent focus:ring-2 focus:ring-brand-blue";
    $value ??= in_array($type, ['text', 'email', 'number', 'url', 'select']) ? old($name) : '';

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
            @foreach($options as $index => $option)
                <option
                    value="{{ $option }}" class="bg-brand-black text-white py-2"

                    {{-- select the old input value or the first one --}}
                    selected="{{ (old($name) === $option) || ($index === 0) ? 'true' : 'false' }}"
                >
                    {{ $option }}
                </option>
            @endforeach
        </select>
    @elseif($type === 'checkbox')
        {{-- 'checkbox' input type --}}
        <div class="flex items-center space-x-2 {{ $formFieldClasses }}">
            <input {{ $attributes }} type="checkbox" name="{{ $name }}" id="{{ $name }}"
                   class="accent-brand-blue w-4 h-4"
            />
            <label for="{{ $name }}">{{ $checkboxLabel ?? $label }}</label>
        </div
    @else
        {{--Default 'text' type --}}
        <x-forms.form-input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
        />
    @endif

    {{-- Form field error message --}}
    @error($name)
        <p class="text-xs text-red-600">{{ $message }}</p>
    @enderror

</div>

