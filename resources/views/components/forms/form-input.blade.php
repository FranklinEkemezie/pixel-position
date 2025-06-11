@props([
    'type'      => 'text',
    'name'
])
<input
    type="{{ $type }}"
    name="{{ $name }}"
    {{ $attributes(
    [
        "class" => "inline-block w-full max-w-3xl border border-gray-100/10 rounded-lg
            p-4 bg-white/10 outline-none focus:border-transparent focus:ring-2
            focus:ring-brand-blue",
        "autocomplete" => "off"
   ]) }}
/>
